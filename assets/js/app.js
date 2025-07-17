import udomdiff from "./udomdiff"

window.onload = function() {
	updateLinks();

	async function updateDom(path) {
		console.log("Updating DOM with content from: ", path);
		const res = await fetch(path);
		const data = await res.text();

		const get = (o) => o;
		const parent = document.querySelector("main");
		const currentNodes = document.querySelector("main").childNodes;
		const dataNodes = new DOMParser()
			.parseFromString(data, "text/html")
			.querySelector("main").childNodes;

		udomdiff(
			parent, // where changes happen
			[...currentNodes], // Array of current items/nodes
			[...dataNodes], // Array of future items/nodes (returned)
			get // a callback to retrieve the node
		);

		updateLinks();
		window.scrollTo(0, 0);
	}

	function updateLinks() {
		document.querySelectorAll("a").forEach((link) => {
			if (link.host === window.location.host) {
				if (link.hasAttribute("data-internal")) {
					return
				}
				link.setAttribute("data-internal", true);

				link.addEventListener("click", async (e) => {
					const destination = link.getAttribute("href");
					e.preventDefault();
					history.pushState({ route: destination }, destination, destination);
					await updateDom(destination);
				});
			} else {
				link.setAttribute("data-external", true);
			}
		});
	}

	window.onpopstate = function() {
		updateDom(window.location.pathname);
	};
};
