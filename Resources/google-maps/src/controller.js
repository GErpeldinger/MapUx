import { Controller } from 'stimulus';
import { Loader } from "@googlemaps/js-api-loader";
import * as MapFunctions from "./MapFunctions.js";

export default class extends Controller {
    async connect() {
        const google = await this.loadGoogleMaps()
        const map = this.createMap(google)

        if (map) {
            this.addMarkersTo(google, map)
            MapFunctions.throwMapEvent(map)
        }
    }

    loadGoogleMaps() {
        const loader = new Loader({
            apiKey: this.element.dataset.key,
        })

        return loader.load()
    }

    createMap(google) {
        const view = JSON.parse(this.element.dataset.view)

        const options = {
            center: {
                lat: view.center.latitude,
                lng: view.center.longitude
            },
            zoom: view.zoom
        }

        return new google.maps.Map(this.element, options)
    }

    addMarkersTo(google, map) {
        if (this.element.dataset.markers) {
            const markersList = JSON.parse(this.element.dataset.markers)

            markersList.forEach(marker => {
                const googleMarker = new google.maps.Marker({
                    position: {
                        lat: marker.position.latitude,
                        lng: marker.position.longitude
                    },
                    map: map,
                });
            })
        }
    }
}
