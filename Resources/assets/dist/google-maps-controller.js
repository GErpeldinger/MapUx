import { Controller } from '@hotwired/stimulus';
import { Loader } from '@googlemaps/js-api-loader';

class googleMapsController extends Controller {
    get el() {
        return this.element;
    }
    async connect() {
        this.google = await this.loadGoogleMaps();
        const map = this.createMap();
        if (map) {
            this.addMarkersTo(map);
            this.throwMapEvent(this.element.id, map);
        }
    }
    loadGoogleMaps() {
        const loader = new Loader({
            apiKey: this.el.dataset.key,
        });
        return loader.load();
    }
    createMap() {
        const view = JSON.parse(this.el.dataset.view);
        const options = {
            center: {
                lat: view.center.latitude,
                lng: view.center.longitude,
            },
            zoom: view.zoom,
        };
        return new this.google.maps.Map(this.el, options);
    }
    addMarkersTo(map) {
        if (this.el.dataset.markers) {
            const markersList = JSON.parse(this.el.dataset.markers);
            markersList.forEach((marker) => {
                const googleMarker = new this.google.maps.Marker({
                    position: {
                        lat: marker.position.latitude,
                        lng: marker.position.longitude,
                    },
                    map: map,
                });
                if (marker.popup) {
                    const infoWindow = new google.maps.InfoWindow({
                        content: marker.popup.content,
                    });
                    googleMarker.addListener("click", () => {
                        infoWindow.open(map, googleMarker);
                    });
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

export { googleMapsController as default };
