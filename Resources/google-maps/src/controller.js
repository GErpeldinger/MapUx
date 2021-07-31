import { Controller } from 'stimulus';
import { Loader } from "@googlemaps/js-api-loader";
import * as functions from "./functions.js";

export default class extends Controller {
    async connect() {
        this.google = await this.loadGoogleMaps()
        const map   = this.createMap()

        if (map) {
            this.addMarkersTo(map)
            functions.throwMapEvent(map)
        }
    }

    loadGoogleMaps() {
        const loader = new Loader({
            apiKey: this.element.dataset.key,
        })

        return loader.load()
    }

    createMap() {
        const view = JSON.parse(this.element.dataset.view)

        const options = {
            center: {
                lat: view.center.latitude,
                lng: view.center.longitude
            },
            zoom: view.zoom
        }

        return new this.google.maps.Map(this.element, options)
    }

    addMarkersTo(map) {
        if (this.element.dataset.markers) {
            const markersList = JSON.parse(this.element.dataset.markers)

            markersList.forEach(marker => {
                const googleMarker = new this.google.maps.Marker({
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
