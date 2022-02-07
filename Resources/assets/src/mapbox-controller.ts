import { Controller } from '@hotwired/stimulus';
import mapboxgl from 'mapbox-gl';

type Marker = {
    position: {
        latitude: number;
        longitude: number;
    };
    popup: {
        content: string;
        options: mapboxgl.PopupOptions
    }
};

export default class extends Controller {
    get el(): HTMLElement {
        return this.element as HTMLElement;
    }

    connect() {
        const map = this.createMap();

        if (map) {
            this.addMarkersTo(map);
            this.throwMapEvent(this.el.id, map);
        }
    }

    createMap() {
        const view = JSON.parse(this.el.dataset.view as string);
        const background = JSON.parse(this.el.dataset.background as string);

        mapboxgl.accessToken = this.el.dataset.key as string;

        return new mapboxgl.Map({
            container: this.el,
            style: background.url,
            center: [view.center.longitude, view.center.latitude],
            zoom: view.zoom,
        });
    }

    addMarkersTo(map: mapboxgl.Map) {
        if (this.el.dataset.markers) {
            const markersList = JSON.parse(this.el.dataset.markers);

            markersList.forEach((marker: Marker) => {
                const mapboxMarker = new mapboxgl.Marker()
                    .setLngLat([marker.position.longitude, marker.position.latitude])
                    .addTo(map);

                if(marker.popup) {
                    mapboxMarker.setPopup(new mapboxgl.Popup(marker.popup.options).setText(marker.popup.content))
                }
            });
        }
    }

    throwMapEvent(id: string, map: mapboxgl.Map) {
        const event = new CustomEvent('mapisloaded', {
            detail: {
                id: id,
                map: map,
            },
        });

        this.element.dispatchEvent(event);
    }
}
