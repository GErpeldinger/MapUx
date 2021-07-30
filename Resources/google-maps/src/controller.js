import { Controller } from 'stimulus';
import * as MapFunctions from "./MapFunctions.js";
import {Loader} from "@googlemaps/js-api-loader";

export default class extends Controller {
    connect() {
        const map = this.createMap()
    }

    createMap() {
        const view = JSON.parse(this.element.dataset.view)

        const loader = new Loader({
            apiKey: this.element.dataset.key,
        })

        const options = {
            center: {
                lat: view.center.latitude,
                lng: view.center.longitude
            },
            zoom: view.zoom
        }
        let map
        loader
            .load()
            .then(google => {
                map = new google.maps.Map(this.element, options);
                if(map) {
                    this.addMarkersTo(map)
                    MapFunctions.throwMapEvent(map)
                }
            }).catch(e => {
                console.error(e);
            })
        return map
    }

    addMarkersTo(map) {
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
