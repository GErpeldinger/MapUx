import { Controller } from 'stimulus';

import * as ol from "ol";
import * as source from 'ol/source';
import * as layer from "ol/layer";
import * as geom from "ol/geom";
import * as proj from "ol/proj";
import * as functions from "./functions";
import {Icon, Style} from "ol/style";

export default class extends Controller {
    connect() {
        const map = this.createMap()

        if (map) {
            this.addMarkerTo(map)
            functions.throwMapEvent(map)
        }
    }

    createSource(layerSource) {
        let layer
        switch (layerSource) {
            case 'OSM':
                layer = new source.OSM()
                break
            default:
                layer = new source.XYZ()
        }
        return layer;
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

                const openLayersMarker = new ol.Feature({
                        geometry: new geom.Point(
                        proj.fromLonLat([marker.position.longitude, marker.position.latitude])
                    )
                })

                if(marker.icon) {
                    const icon = new Style({
                        image: new Icon(marker.icon.parameters)
                    })
                    openLayersMarker.setStyle(icon)
                }

                markers.push(openLayersMarker);
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
