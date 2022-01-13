import { Controller } from 'stimulus';

import * as ol from "ol";
import * as source from 'ol/source';
import * as layer from "ol/layer";
import * as geom from "ol/geom";
import * as proj from "ol/proj";
import * as functions from "./functions";

export default class extends Controller {
    connect() {
        const map = this.createMap()

        if (map) {
            this.addMarkerTo(map)
            functions.throwMapEvent(map, this.element.id)
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

                const olMarker = new geom.Point(
                    proj.fromLonLat([marker.position.longitude, marker.position.latitude])
                )

                if(marker.popup) {
                    this.addPopup(map, marker)
                }

                markers.push(new ol.Feature({
                    geometry: olMarker
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


    createPopup(popupId) {

        const popup = document.createElement('div')
        popup.id = popupId
        popup.classList.add(popupId)

        const popupContent = document.createElement('div')
        popupContent.id = popupId + '-content'

        const closeLink = document.createElement('a')
        closeLink.href = '#'
        closeLink.id = popupId + '-closer'
        closeLink.classList.add(popupId + '-closer')

        popup.appendChild(closeLink)
        popup.appendChild(popupContent)

        return popup

    }

    addPopup(map, marker) {
        const popupId = 'ol-popup'

        if(!document.getElementById(popupId)) {
            document.body.appendChild(this.createPopup(popupId))
        }
        const container = document.getElementById(popupId);
        const content   = document.getElementById(popupId + '-content');
        const closer    = document.getElementById(popupId + '-closer');

        const overlay = this.createOverlay(container, marker)

        map.addOverlay(overlay);

        closer.onclick = () => {
            overlay.setPosition(undefined);
            closer.blur();
            return false;
        };

        map.on('singleclick', function (event) {
            if (map.hasFeatureAtPixel(event.pixel) === true) {
                const coordinate = event.coordinate;
                content.innerHTML = marker.popup.content;
                overlay.setPosition(coordinate);
            } else {
                overlay.setPosition(undefined);
                closer.blur();
            }
        });
    }

    createOverlay(container, marker) {
        return new ol.Overlay({
            element: container,
            autoPan: true,
            autoPanAnimation: {
                duration: marker.popup.options.duration ?? 250
            }
        });
    }
}
