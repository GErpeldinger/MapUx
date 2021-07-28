import { Controller } from 'stimulus';

import Map from 'ol/Map';
import View from 'ol/View';
import TileLayer from 'ol/layer/Tile';
import XYZ from 'ol/source/XYZ';

export default class extends Controller {
    connect() {
        const view = new View(JSON.parse(this.element.dataset.view))
        const background = new XYZ(JSON.parse(this.element.dataset.background))

        const tileLayer = new TileLayer({
            source: background
        })

        new Map({
            target: this.element,
            layers: [tileLayer],
            view: view
        })
    }
}