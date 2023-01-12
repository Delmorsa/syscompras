webix.protoUI(
	{
		name: "navbar",
		defaults: {
			height: 60,
			css: "navbar",
			template: function (obj) {
				var readMore = obj.readmore
					? "<span><a class='btn-contour' href='" +
					obj.readmore +
					"' target='_blank'>Read More</a></span>"
					: "";

				var navigation = "";
				for (var i = 0; i < obj.allDemos.length; i++) {
					var active = obj.allDemos[i].name == obj.name ? "nav-dot-active" : "";

					navigation +=
						"<a href='../" +
						obj.allDemos[i].name +
						"/index.html' class='nav-dot " +
						active +
						"'>\
												<span class='nav-tooltip'>" +
						obj.allDemos[i].title +
						"</span>\
											</a>";
				}

				/* return (
				   "<div class='nav-inner grid grid-v-center grid-h-center'>\
								 <div class='nav-panel grid grid-v-center grid-h-center'>\
									 <span class='nav-button-wrap nav-prev-button-wrap'>\
										 <a class='prev' href='../" +
				   obj.prev.name +
				   "/index.html'><img src='/demos/common/icons/Arrow-Left.svg' />" +
				   obj.prev.title +
				   "</a>\
									 </span>\
									 <div class='nav-dots-wrap'>" +
				   navigation +
				   "</div>\
									 <span class='nav-button-wrap nav-next-button-wrap'>\
										 <a class='next' href='../" +
				   obj.next.name +
				   "/index.html'>" +
				   obj.next.title +
				   "<img src='/demos/common/icons/Arrow-Right.svg' /></a>\
									 </span>\
								 </div>\
								 <div class='nav-buttons'>" +
				   readMore +
				   "<span><a class='btn' href='" +
				   obj.link +
				   "' target='_blank'>Download Webix</a></span>\
								 </div>\
							 </div>"
				 );*/
			},
		},

		value_setter: function (value) {
			var index = 0;
			for (var i = 0; i < this.demos.length; i++)
				if (this.demos[i].name == value) index = i;

			this.data = this.demos[index];
			this.data.allDemos = this.demos;
			this.data.next = this.demos[(index + 1) % this.demos.length];
			this.data.prev = this.demos[
			(index - 1 + this.demos.length) % this.demos.length
				];
		},

		demos: [
			/*{
				name: "qa-dashboard",
				title: "QA Dashboard",
				link: "/download/",
				readmore: "/demo/qa-dashboard/",
			},
			{
				name: "student-dashboard",
				title: "Student Dashboard",
				link: "/download/",
				readmore: "/demo/student-teachers-dashboard/",
			},
			{
				name: "bank-app",
				title: "Bank App",
				link: "/download/",
				readmore: "/demo/bank-app/",
			},
			{
				name: "booking-app",
				title: "Booking App",
				link: "/download/",
				readmore: "/demo/booking-app/",
			},
			{
				name: "team-progress",
				title: "Team Progress App",
				link: "/download/",
				readmore: "/demo/team-progress/",
			},
			{
				name: "web-desktop",
				title: "Web Desktop UI",
				link: "/download/",
				readmore: "/demo/web-desktop/",
			},
			{
				name: "geo-explorer",
				title: "Geo Explorer",
				link: "/download/",
				readmore: "/demo/geo-explorer/",
			},
			{
				name: "pivot",
				title: "Pivot",
				link: "/pivot/download.html",
				readmore: "/pivot/"
			},
			{
				name: "spreadsheet",
				title: "Spreadsheet",
				link: "/spreadsheet/download.html",
				readmore: "/spreadsheet/"
			},
			{
				name: "kanban",
				title: "Kanban",
				link: "/kanban/download.html",
				readmore: "/kanban/"
			},
			{
				name: "filemanager",
				title: "File Manager",
				link: "/filemanager/download.html",
				readmore: "/filemanager/"
			},
			{
				name: "scheduler",
				title: "Scheduler",
				link: "/scheduler/download.html",
				readmore: "/scheduler/"
			},*/
			{
				name: "query",
				title: "Query",
				link: "/widget/querybuilder/download.html",
				readmore: "/widget/querybuilder/"
			}/*,
			{
				name: "document-manager",
				title: "Document Manager",
				link: "/widgets/document-manager/download.html",
				readmore: "/widgets/document-manager/"
			},
			{
				name: "user-manager",
				title: "User Manager",
				link: "/widgets/user-manager/download.html",
				readmore: "/widgets/user-manager/"
			},
			{
				name: "chat-messenger",
				title: "Chat / Messenger",
				link: "/widgets/chat-messenger/download.html",
				readmore: "/widgets/chat-messenger/"
			},
			{
				name: "gantt",
				title: "Gantt",
				link: "/gantt/download.html",
				readmore: "/gantt/"
			},
			{
				name: "report-manager",
				title: "Report Manager",
				link: "/widgets/report-manager/download.html",
				readmore: "/widgets/report-manager/"
			},
			{
				name: "js-diagram",
				title: "Diagram Library",
				link: "/js-diagram/download.html",
				readmore: "/js-diagram/"
			},*/
		],
	},
	webix.ui.template
);
