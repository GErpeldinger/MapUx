import { Controller } from '@hotwired/stimulus';
import * as ol from 'ol';
import * as source from 'ol/source';
import * as layer from 'ol/layer';
import * as geom from 'ol/geom';
import * as proj from 'ol/proj';

class openLayersController extends Controller {
    get el() {
        return this.element;
    }
    connect() {
        const map = this.createMap();
        if (map) {
            this.addMarkerTo(map);
            this.throwMapEvent(this.el.id, map);
        }
    }
    createMap() {
        const view = JSON.parse(this.el.dataset.view);
        const background = JSON.parse(this.el.dataset.background);
        const layerSource = this.createSource(background.layerSource);
        layerSource.setUrl(background.url);
        const tileLayer = new layer.Tile({
            source: layerSource,
        });
        return new ol.Map({
            target: this.el,
            layers: [tileLayer],
            view: new ol.View({
                center: proj.fromLonLat([view.center.longitude, view.center.latitude]),
                zoom: view.zoom,
            }),
        });
    }
    addMarkerTo(map) {
        if (this.el.dataset.markers) {
            const markersList = JSON.parse(this.el.dataset.markers);
            const markers = [];
            markersList.forEach((marker) => {
                const olMarker = new geom.Point(proj.fromLonLat([marker.position.longitude, marker.position.latitude]));
                if (marker.popup) {
                    this.addPopup(map, marker);
                }
                markers.push(new ol.Feature({
                    geometry: olMarker,
                }));
            });
            const markersLayer = new layer.Vector({
                source: new source.Vector({
                    features: markers,
                }),
            });
            map.addLayer(markersLayer);
        }
    }
    addPopup(map, marker) {
        const popupId = 'ol-popup';
        if (!document.getElementById(popupId)) {
            document.body.appendChild(this.createPopup(popupId));
        }
        const container = document.getElementById(popupId);
        const content = document.getElementById(popupId + '-content');
        const closer = document.getElementById(popupId + '-closer');
        const overlay = this.createOverlay(container, marker);
        map.addOverlay(overlay);
        closer.onclick = () => {
            overlay.setPosition(undefined);
            closer.blur();
            return false;
        };
        map.on('singleclick', function (event) {
            if (map.hasFeatureAtPixel(event.pixel)) {
                const coordinate = event.coordinate;
                content.innerHTML = marker.popup.content;
                overlay.setPosition(coordinate);
            }
            else {
                overlay.setPosition(undefined);
                closer.blur();
            }
        });
    }
    createPopup(popupId) {
        const popup = document.createElement('div');
        popup.id = popupId;
        popup.classList.add(popupId);
        const popupContent = document.createElement('div');
        popupContent.id = popupId + '-content';
        const closeLink = document.createElement('a');
        closeLink.href = '#';
        closeLink.id = popupId + '-closer';
        closeLink.classList.add(popupId + '-closer');
        popup.appendChild(closeLink);
        popup.appendChild(popupContent);
        return popup;
    }
    createOverlay(container, marker) {
        var _a, _b;
        return new ol.Overlay({
            element: container,
            autoPan: true,
            autoPanAnimation: {
                duration: (_b = (_a = marker.popup.options) === null || _a === void 0 ? void 0 : _a.duration) !== null && _b !== void 0 ? _b : 250
            }
        });
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
    createSource(layerSource) {
        let layer;
        switch (layerSource) {
            case 'OSM':
                layer = new source.OSM();
                break;
            default:
                layer = new source.XYZ();
        }
        return layer;
    }
}

export { openLayersController as default };
