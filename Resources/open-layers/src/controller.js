import { Controller } from 'stimulus';

import * as ol from "ol";
import * as source from 'ol/source';
import * as layer from "ol/layer";
import * as geom from "ol/geom";
import * as proj from "ol/proj";
import * as MapFunctions from "./MapFunctions";

export default class extends Controller {
    connect() {
        const map = this.createMap()
        if(map) {
            this.addMarkerTo(map)
            MapFunctions.throwMapEvent(map)
        }
    }

    createMap() {
        const view = JSON.parse(this.element.dataset.view)
        const background = new source.XYZ(JSON.parse(this.element.dataset.background))

        const tileLayer = new layer.Tile({
            source: background
        })

        return new ol.Map({
            target: this.element,
            layers: [tileLayer],
            view: new ol.View({
                center: proj.fromLonLat(view.center),
                zoom: view.zoom
            })
        })
    }

    addMarkerTo(map) {
        if (this.element.dataset.markers) {
            const markersList = JSON.parse(this.element.dataset.markers)

            const markers = []
            markersList.forEach(marker => {
                markers.push(new ol.Feature({
                    geometry: new geom.Point(
                        proj.fromLonLat([marker.position.longitude, marker.position.latitude])
                    )
                }));
            })

            const markersLayer = new layer.Vector({
                source: new source.Vector({
                    features: markers
                }),
            })

            map.addLayer(markersLayer)
        }
    }
}
