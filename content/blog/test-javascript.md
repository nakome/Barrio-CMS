Title: Testeando Javascript
Description: Incluye el Javascript para crear paginas personalizadas.
Template: blank
----



<div class="container">
	<div class="row mt-3">
		<div class="col-md-8 m-auto">
			<p><a href="[Site_url]/blog">&#x21A9; Volver al Blog</a></p>
			<p>Buscador usando Agnolia api.</p>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-8 m-auto" id="root">
			<div class="input-group">
			  <div class="input-group-prepend">
			    <span class="input-group-text">Buscar</span>
			  </div>
			  <input id="search" type="text" class="form-control" placeholder="Por ejemplo css" aria-label="Barra de busqueda">
			</div>
			<div class="list-group mt-2" id="output"></div>
		</div>
	</div>
</div>



[Scripts minify=true]
!(function () {
	let hits = [],
		url = "https://hn.algolia.com/api/v1/search?query=",
		query = "classless",
		search = document.querySelector("#search"),
		output = document.querySelector("#output");

	// fetchData
	const fetchData = async (query) => {
		const result = await fetch(url + query);
		const response = await result.json();
		return response;
	};
	// render output
	const renderData = (data) => {
		let html = "";
		data.map((item) => {
			if(item.title.length > 0 || typeof item.title !== null) {
				html += `<a id="${item.objectID}" target="_blank" href="${item.url}" title="${item.title}" class="list-group-item list-group-item-action">${item.title}</a>`;
			}
		});
		output.innerHTML = html;
	};
	// get data
	fetchData(query).then((r) => renderData(r.hits));
	// on key up get data
	search.addEventListener("keyup", (evt) => {
		evt.preventDefault();
		let val = evt.target.value;
		if (val) fetchData(val).then((r) => renderData(r.hits));
	});
})();
[/Scripts]