update-hugo:
	#!/usr/bin/env bash

	latestTag="$(gh release view -R gohugoio/hugo --json tagName | jq -r .tagName)"
	version="${latestTag#v}"
	mise use --pin "hugo-extended@$version"

	# statichost.yml
	file="statichost.yml"
	image="ghcr.io/gohugoio/hugo"
	printf "$file before => "
	grep "$image" $file
	sed -i "s!$image:.*!$image:$latestTag!" $file
	printf "$file after => "
	grep "$image" $file

build:
	hugo build
