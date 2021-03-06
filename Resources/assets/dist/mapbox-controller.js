import { Controller } from '@hotwired/stimulus';
import mapboxgl from 'mapbox-gl';

class mapboxController extends Controller {
    get el() {
        return this.element;
    }
    connect() {
        const map = this.createMap();
        if (map) {
            this.addMarkersTo(map);
            this.throwMapEvent(this.el.id, map);
        }
    }
    createMap() {
        const view = JSON.parse(this.el.dataset.view);
        const background = JSON.parse(this.el.dataset.background);
        mapboxgl.accessToken = this.el.dataset.key;
        return new mapboxgl.Map({
            container: this.el,
            style: background.url,
            center: [view.center.longitude, view.center.latitude],
            zoom: view.zoom,
        });
    }
    addMarkersTo(map) {
        if (this.el.dataset.markers) {
            const markersList = JSON.parse(this.el.dataset.markers);
            markersList.forEach((marker) => {
                const mapboxMarker = new mapboxgl.Marker()
                    .setLngLat([marker.position.longitude, marker.position.latitude])
                    .addTo(map);
                if (marker.popup) {
                    mapboxMarker.setPopup(new mapboxgl.Popup(marker.popup.options).setText(marker.popup.content));
                }
            });
        }
    }
    throwMapEvent(id, map) {
        const event = new CustomEvent('mapisloaded', {
            detail: {
                id: id,
                map: map,
            },
        });
        this.element.dispatchEvent(event);
    }
}

export { mapboxController as default };
