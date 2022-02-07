import { Controller } from 'stimulus';
import mapboxgl from 'mapbox-gl';
import * as functions from "./functions.js";


export default class extends Controller {
    connect() {
        const map = this.createMap()

        if (map) {
            this.addMarkersTo(map)
            functions.throwMapEvent(map, this.element.id)
        }
    }

    createMap() {
        const view       = JSON.parse(this.element.dataset.view)
        const background = JSON.parse(this.element.dataset.background)

        mapboxgl.accessToken = this.element.dataset.key

        return new mapboxgl.Map(
            {
                container: this.element,
                style: background.url,
                center: [view.center.longitude, view.center.latitude],
                zoom: view.zoom
            }
        );
    }

    addMarkersTo(map) {
        if (this.element.dataset.markers) {
            const markersList = JSON.parse(this.element.dataset.markers)

            markersList.forEach(marker => {
                const mapboxMarker = new mapboxgl.Marker()
                    .setLngLat([marker.position.longitude, marker.position.latitude])
                    .addTo(map);

                if(marker.popup) {
                    this.addPopupToMarker(mapboxMarker, marker)
                }
            })
        }
    }

    addPopupToMarker(leafletMarker, marker) {
        leafletMarker.setPopup(new mapboxgl.Popup(marker.popup.options).setText(
            marker.popup.content
        ))
    }
}
