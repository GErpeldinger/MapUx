import { Controller } from '@hotwired/stimulus';
import * as L from 'leaflet';
import marker from 'leaflet/dist/images/marker-icon.png';
import marker2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';

class leafletController extends Controller {
    get el() {
        return this.element;
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
        const view = JSON.parse(this.el.dataset.view);
        const background = JSON.parse(this.el.dataset.background);
        const map = L.map(this.el).setView([view.center.latitude, view.center.longitude], view.zoom);
        L.tileLayer(background.url, background.options).addTo(map);
        return map;
    }
    addMarkersTo(map) {
        if (this.el.dataset.markers) {
            const markersList = JSON.parse(this.el.dataset.markers);
            markersList.forEach((marker) => {
                const leafletMarker = L.marker([marker.position.latitude, marker.position.longitude]).addTo(map);
                if (marker.tooltip) {
                    this.addTooltipToMarker(leafletMarker, marker);
                }
                if (marker.popup) {
                    this.addPopupToMarker(leafletMarker, marker);
                }
            });
        }
    }
    addTooltipToMarker(leafletMarker, marker) {
        leafletMarker.bindTooltip(marker.tooltip.content, marker.tooltip.options);
    }
    addPopupToMarker(leafletMarker, marker) {
        leafletMarker.bindPopup(marker.popup.content, marker.popup.options);
    }
    redefineIcons() {
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: marker2x,
            iconUrl: marker,
            shadowUrl: markerShadow,
        });
    }
    throwMapEvent(id, map) {
        const event = new CustomEvent('mapisloaded', {
            detail: {
                id: id,
                map: map,
            },
        });
        this.el.dispatchEvent(event);
    }
}

export { leafletController as default };
