.PHONY: install
install:
	cd Resources/leaflet && yarn install
	cd Resources/open-layer && yarn install

.PHONY: build
build:
	cd Resources/leaflet && yarn build
	cd Resources/open-layer && yarn build
