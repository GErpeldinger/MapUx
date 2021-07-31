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

    createSource(layerSource) {
        switch (layerSource) {
            case 'OSM':
                return new source.OSM()
                break
            default:
                return new source.XYZ()
        }
    }

    createMap() {
        const view        = JSON.parse(this.element.dataset.view)
        const background  = JSON.parse(this.element.dataset.background)
        const layerSource = this.createSource(background.layerSource);

        layerSource.setUrl(background.url);

        const tileLayer = new layer.Tile({
            source: layerSource
        })

        return new ol.Map({
            target: this.element,
            layers: [tileLayer],
            view: new ol.View({
                center: proj.fromLonLat([view.center.longitude, view.center.latitude]),
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
