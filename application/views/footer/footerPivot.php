<!--<script src="<?php echo base_url()?>assets/js/flexmonster.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/flexmonster.toolbar.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/lib/jspdf.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/lib/html2canvas.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/lib/d3.v3.min.js"></script>-->

<script type="text/javascript">

$(document).ready(function () {
		cargarPivot();
		/*$("#btnShow").click(function () {
			cargarPivot();
		});*/
		
	});

	function cargarPivot(){
		webix.i18n.decimalSize = 4;
		webix.i18n.setLocale();
		webix.i18n.pivot = {
			apply: "Aplicar",
			cancel: "Cancelar",
			columns: "Columnas (agrupar)",
			count: "contar",
			datepicker: "Fecha",
			fields: "Campos",
			filters: "Filtros",
			max: "Max",
			multicombo: "seleccion multiple",
			min: "Min",
			operationNotDefined: "Operacion sin definir",
			pivotMessage: "Click para configurar",
			rows: "Filas",
			select: "Lista",
			sum: "	Suma",
			text: "Texto",
			values: "Valores (Datos de la tabla)",
			windowTitle: "Configuracion",
			windowMessage: "Arrastre los campos aqui"
		};

		let pivot_dataset = null;
		$.ajax({
			url: "<?php echo base_url()?>index.php/mostrarSolicitudesRpt/"+6,
			type: "GET",
			async: false,
			success: function (data) {

				pivot_dataset = data
			}
		});

		if (!webix.env.touch && webix.env.scrollSize)
			webix.CustomScroll.init();

		var dataCollection = new webix.DataCollection({
			url:"<?php echo base_url()?>index.php/mostrarSolicitudesRpt/"+6,
		});

		var valueFields = {"Area":1, "Consecutivo": 1};
 
		let pivot = {
			view: "scrollview",
			scroll: "y",
			body: {
				rows:[
					// pivot table
					{
						height: 750,
						cols: [
							{
								gravity: 2,
								id: "pivot",
								view: "pivot",
								url:"<?php echo base_url()?>index.php/mostrarSolicitudesRpt/"+6,
								totalColumn: true,
								//footer: true,
								//data:dataCollection,
								datatable:{
									pager:"pivotPager",
									template:function(data, common){
										var current = data.page + 1;
										var html = "<select onchange='grida.setPage(this.value-1)'"+
												"style='text-align:center; width:150px'>";
										for (var i=1; i<=data.limit; i++)
											html+="<option "+(i == current?"selected='true'":"")+">"+i+"</option>";
										html+="</select> from "+data.limit;
										return html;
									},
								},
								height:700,
								structure: {
									rows: ["Area","Consecutivo"],
									columns: ["FechaCrea"],
									values: [{name: "Consecutivo", operation: ["avg"]}],//[{name: "CLIENTE", operation: ["avg"]}],
									filters: [
										{name: "PersonalCompra", type: "multiselect"},
										{name: "FechaAutoriza", type: "select"},
										{name: "Prioridad", type: "multiselect"}
									]
								},
								on:{
									onBeforeRender:function(config){
										let columns = config.header;
										for (i = 0; i < columns.length; i++){
											if (columns[i].id.indexOf("string") != -1){
												columns[i].format = function(value){
													return value;
												};
												columns[i].sort = "string"
											}
											if (i >0){ //all columns except 1st
												columns[i].template = function(obj, common){
													if(obj.$count > 0)
														return "";
													return obj[this.id];
												}
											}
										}
									},
									onViewInit: function (name, config) {

										$$("pivot").addOperation("texto", function(data) {
											return data
										})

										if(name == "filters" && $$("filters")){
											webix.ui(config.elements, $$("filters"));
											config.elements = false;
										}

										/*let datatable = $$("pivot").$$("data");
										datatable.attachEvent("onAfterSelect", function (data) {
											alert("selected row: "+data);
										});*/
									}
								},
								popup:{
									popupWidth:1000,
									height:650,
									on:{
										onViewInit: function(name, config){
											if(name == "fields"){
												config.view = "unitlist";
												config.uniteBy = function(item){
													return valueFields[item.text]?"Valores Numéricos":"Valores de texto";
												};
											}

											if(name == "fieldsLayout"){
												config.rows.splice(1,0,{
													id: "fieldsFilter",
													css: "fields_search",
													view: "search",
													on:{
														onTimedKeyPress: function () {
															let value = this.getValue().toLowerCase();
															$$("pivot").getConfigWindow().$$("fields").filter("name", value);
														}
													}
												});
											}
										}
									}
								}
							},
							{ view:"resizer"},
							{
								rows:[
									{
										id: "filters",
										view: "form",
										rows:[{}]
									},
									{template:" ", borderless:true}
								]
							}
						]
					},
					// pivot chart
					/*{
						height: 300,
						cols:[
							{
								id:"pivotChart",
								view:"pivot-chart",
								gravity: 2,
								data:pivot_dataset,
								structure:{
									groupBy: "ANIO",
									values: [{name:"balance", operation:"max", color: "#eed236"},{name:"oil", operation:"max", color: "#36abee"},{name:"gdp", operation:"max", color: "#476cee"}],
									filters:[{name:"continent", type:"select"},{name:"name", type:"select"}]
								},
								chartType: "line",
								chart: {
									scale: "logarithmic",
									barWidth: 25,
									legend: {
										layout: "x",
										align: "center",
										valign: "bottom"
									}
								},
								on:{
									onViewInit: function(name, config){
										if(name == "filters" && $$("chartFilters"))
											webix.ui(config.elements, $$("chartFilters"));
										config.elements = false;
									}
								}
							},
							{
								view: "form",
								rows:[
									{ id: "chartFilters", rows:[]},
									{},
									{ view: "button", label: "Change Structure", click: function(){
											$$("pivotChart").configure()
										}}
								]
							}
						]
					}*/
				]
			}
		}


		let paging = {
			container:"paging_here",
			view:"pager",
			id:"pivotPager",
			size:20,
			group:10
		};

		/* //gravity: 2,
			id: "pivot",
			view: "pivot",
			totalColumn: true,
			//footer: true,
			data:pivot_dataset,
			datatable:{
				pager:"pivotPager"
			},
			height:700,
			structure: {
				rows: [],//["DESCRIPCION"],
				columns: [],//["WhsName"],
				values: [],//[{name: "CLIENTE", operation: ["avg"]}],
				filters: [
					{name: "CATEGORIA", type: "select"},
					{name: "NOMBRECOMERCIAL", type: "select"},
					{name: "FECHA", type: "datepicker"}
				]
			},
			on:{
				onBeforeRender:function(config){
					let columns = config.header;
					for (i = 0; i < columns.length; i++){
						if (columns[i].id.indexOf("string") != -1){
							columns[i].format = function(value){
								return value;
							};
							columns[i].sort = "string"
						}
						if (i >0){ //all columns except 1st
							columns[i].template = function(obj, common){
								if(obj.$count > 0)
									return "";
								return obj[this.id];
							}
						}
					}
				},
				onViewInit: function (name, config) {
					if(name == "filters" && $$("filters")){
						webix.ui(config.elements, $$("filters"));
						config.elements = false;
					}
				}
			},
			popup:{
				popupWidth:1000,
				height:650,
				on:{
					onViewInit: function(name, config){
						if(name == "fields"){
							config.view = "unitlist";
							config.uniteBy = function(item){
								return valueFields[item.text]?"Valores Numéricos":"Valores de texto";
							};
						}

						if(name == "fieldsLayout"){
							config.rows.splice(1,0,{
								id: "fieldsFilter",
								css: "fields_search",
								view: "search",
								on:{
									onTimedKeyPress: function () {
										let value = this.getValue().toLowerCase();
										$$("pivot").getConfigWindow().$$("fields").filter("name", value);
									}
								}
							});
						}
					}
				}
			}
		* */

		webix.ui({
			rows: [
				pivot,
				paging
			]

		});
		//#green
		/*webix.toPDF($$("pivot"));
		webix.toExcel($$("pivot"));
		webix.toPNG($$("pivot"));
		webix.toCSV($$("pivot"));*/

		/*$$("pivot").addOperation("avg", function(values, key, data, ids) {
			var sum = 0;
			for (i = 0; i < values.length; i++)
				sum+=values[i]*1;
			return values.length?(sum/values.length):0;
		});

		$$("pivot").addOperation("texto", function(data) {
			return data
		});*/

		//$$("pivot").parse(webix.copy(pivot_dataset));
		//#
	}
</script>