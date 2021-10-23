"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");

var _typeof = require("@babel/runtime/helpers/typeof");

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _classCallCheck2 = _interopRequireDefault(require("@babel/runtime/helpers/classCallCheck"));

var _createClass2 = _interopRequireDefault(require("@babel/runtime/helpers/createClass"));

var _inherits2 = _interopRequireDefault(require("@babel/runtime/helpers/inherits"));

var _possibleConstructorReturn2 = _interopRequireDefault(require("@babel/runtime/helpers/possibleConstructorReturn"));

var _getPrototypeOf2 = _interopRequireDefault(require("@babel/runtime/helpers/getPrototypeOf"));

var _stimulus = require("stimulus");

var ol = _interopRequireWildcard(require("ol"));

var source = _interopRequireWildcard(require("ol/source"));

var layer = _interopRequireWildcard(require("ol/layer"));

var geom = _interopRequireWildcard(require("ol/geom"));

var proj = _interopRequireWildcard(require("ol/proj"));

var functions = _interopRequireWildcard(require("./functions"));

var _style = require("ol/style");

function _getRequireWildcardCache(nodeInterop) { if (typeof WeakMap !== "function") return null; var cacheBabelInterop = new WeakMap(); var cacheNodeInterop = new WeakMap(); return (_getRequireWildcardCache = function _getRequireWildcardCache(nodeInterop) { return nodeInterop ? cacheNodeInterop : cacheBabelInterop; })(nodeInterop); }

function _interopRequireWildcard(obj, nodeInterop) { if (!nodeInterop && obj && obj.__esModule) { return obj; } if (obj === null || _typeof(obj) !== "object" && typeof obj !== "function") { return { "default": obj }; } var cache = _getRequireWildcardCache(nodeInterop); if (cache && cache.has(obj)) { return cache.get(obj); } var newObj = {}; var hasPropertyDescriptor = Object.defineProperty && Object.getOwnPropertyDescriptor; for (var key in obj) { if (key !== "default" && Object.prototype.hasOwnProperty.call(obj, key)) { var desc = hasPropertyDescriptor ? Object.getOwnPropertyDescriptor(obj, key) : null; if (desc && (desc.get || desc.set)) { Object.defineProperty(newObj, key, desc); } else { newObj[key] = obj[key]; } } } newObj["default"] = obj; if (cache) { cache.set(obj, newObj); } return newObj; }

function _createSuper(Derived) { var hasNativeReflectConstruct = _isNativeReflectConstruct(); return function _createSuperInternal() { var Super = (0, _getPrototypeOf2["default"])(Derived), result; if (hasNativeReflectConstruct) { var NewTarget = (0, _getPrototypeOf2["default"])(this).constructor; result = Reflect.construct(Super, arguments, NewTarget); } else { result = Super.apply(this, arguments); } return (0, _possibleConstructorReturn2["default"])(this, result); }; }

function _isNativeReflectConstruct() { if (typeof Reflect === "undefined" || !Reflect.construct) return false; if (Reflect.construct.sham) return false; if (typeof Proxy === "function") return true; try { Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); return true; } catch (e) { return false; } }

var _default = /*#__PURE__*/function (_Controller) {
  (0, _inherits2["default"])(_default, _Controller);

  var _super = _createSuper(_default);

  function _default() {
    (0, _classCallCheck2["default"])(this, _default);
    return _super.apply(this, arguments);
  }

  (0, _createClass2["default"])(_default, [{
    key: "connect",
    value: function connect() {
      var map = this.createMap();

      if (map) {
        this.addMarkerTo(map);
        functions.throwMapEvent(map);
      }
    }
  }, {
    key: "createSource",
    value: function createSource(layerSource) {
      var layer;

      switch (layerSource) {
        case 'OSM':
          layer = new source.OSM();
          break;

        default:
          layer = new source.XYZ();
      }

      return layer;
    }
  }, {
    key: "createMap",
    value: function createMap() {
      var view = JSON.parse(this.element.dataset.view);
      var background = JSON.parse(this.element.dataset.background);
      var layerSource = this.createSource(background.layerSource);
      layerSource.setUrl(background.url);
      var tileLayer = new layer.Tile({
        source: layerSource
      });
      return new ol.Map({
        target: this.element,
        layers: [tileLayer],
        view: new ol.View({
          center: proj.fromLonLat([view.center.longitude, view.center.latitude]),
          zoom: view.zoom
        })
      });
    }
  }, {
    key: "addMarkerTo",
    value: function addMarkerTo(map) {
      if (this.element.dataset.markers) {
        var markersList = JSON.parse(this.element.dataset.markers);
        var markers = [];
        markersList.forEach(function (marker) {
          var openLayersMarker = new ol.Feature({
            geometry: new geom.Point(proj.fromLonLat([marker.position.longitude, marker.position.latitude]))
          });

          if (marker.icon) {
            var icon = new _style.Style({
              image: new _style.Icon(marker.icon.parameters)
            });
            openLayersMarker.setStyle(icon);
          }

          markers.push(openLayersMarker);
        });
        var markersLayer = new layer.Vector({
          source: new source.Vector({
            features: markers
          })
        });
        map.addLayer(markersLayer);
      }
    }
  }]);
  return _default;
}(_stimulus.Controller);

exports["default"] = _default;