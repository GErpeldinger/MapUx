import { Controller } from 'stimulus';
import * as MapFunctions from "./MapFunctions.js";
import {Loader} from "@googlemaps/js-api-loader";

export default class extends Controller {
    connect() {

        const map = this.createMap()
        if(map) {
            this.addMarkersTo(map)
            MapFunctions.throwMapEvent(map)
        }
    }

    createMap() {
        const view = JSON.parse(this.element.dataset.view)
        const background = JSON.parse(this.element.dataset.background)

        console.log('view : ', view)
        console.log('bg : ', background)

        const loader = new Loader({
            apiKey: this.element.dataset.key,
            version: "weekly",
            libraries: ["places"]
        })

        const mapOptions = {
            center: {
                lat: view.center.latitude,
                lng: view.center.longitude
            },
            zoom: view.zoom
        }
        loader
            .load()
            .then(google => {
                const map = new google.maps.Map(this.element, mapOptions);
            }).catch(e => {
                // do something
            })
        return map
    }

    addMarkersTo(map) {
        if (this.element.dataset.markers) {

        }
    }

}
