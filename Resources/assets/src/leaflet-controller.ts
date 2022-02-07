import { Controller } from '@hotwired/stimulus';
import * as L from 'leaflet';

// @ts-ignore
import marker from 'leaflet/dist/images/marker-icon.png';
// @ts-ignore
import marker2x from 'leaflet/dist/images/marker-icon-2x.png';
// @ts-ignore
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

type Marker = {
    position: {
        latitude: number;
        longitude: number;
    };
    tooltip: {
        content: string;
        options?: L.TooltipOptions;
    };
    popup: {
        content: string,
        options?: L.PopupOptions
    };
};

export default class extends Controller {
    get el(): HTMLElement {
        return this.element as HTMLElement;
    }

    connect() {
        this.redefineIcons();
        const map = this.createMap();
        if (map) {
            this.addMarkersTo(map);
            this.throwMapEvent(this.el.id, map);
        }
    }

    createMap() {
        const view = JSON.parse(this.el.dataset.view as string);
        const background = JSON.parse(this.el.dataset.background as string);

        const map = L.map(this.el).setView(
            [view.center.latitude, view.center.longitude],
            view.zoom
        );

        L.tileLayer(background.url, background.options).addTo(map);

        return map;
    }

    addMarkersTo(map: L.Map) {
        if (this.el.dataset.markers) {
            const markersList = JSON.parse(this.el.dataset.markers);

            markersList.forEach((marker: Marker) => {
                const leafletMarker = L.marker([marker.position.latitude, marker.position.longitude]).addTo(map);

                if (marker.tooltip) {
                    this.addTooltipToMarker(leafletMarker, marker);
                }

                if(marker.popup) {
                    this.addPopupToMarker(leafletMarker, marker)
                }
            });
        }
    }

    addTooltipToMarker(leafletMarker: L.Marker, marker: Marker) {
        leafletMarker.bindTooltip(marker.tooltip.content, marker.tooltip.options);
    }

    addPopupToMarker(leafletMarker: L.Marker, marker: Marker) {
        leafletMarker.bindPopup(marker.popup.content, marker.popup.options)
    }

    /**
     * for some obscure reason, when we use Webpack, we have to redefine the icons :/
     * https://github.com/Leaflet/Leaflet/issues/4968
     */
    redefineIcons() {
        // @ts-ignore
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: marker2x,
            iconUrl: marker,
            shadowUrl: markerShadow,
        });
    }

    throwMapEvent(id: string, map: L.Map) {
        const event = new CustomEvent('mapisloaded', {
            detail: {
                id: id,
                map: map,
            },
        });

        this.el.dispatchEvent(event);
    }
}
