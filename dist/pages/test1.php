<head>
	<link rel="stylesheet" type="css" href="css/tab.css" />
	<script src="js/tab.js" type="text/javascript"></script>
</head>
<body>
	<div class="tab-wrapper">
	<div class="tab-button-wrapper">
		<ul>
			<li><a class="tab-button-first"
				id="tab-button1"
				href="javascript:void(0)"
				onclick="loadTab(1)">Tab 1</a></li>
			<li><a class="tab-button-hidden" 
				id="tab-button2"
				href="javascript:void(0)"
				onclick="loadTab(2)">Tab 2</a></li>
			<li><a class="tab-button-hidden tab-button-last" 
				id="tab-button3"
				href="javascript:void(0)"
				onclick="loadTab(3)">Tab 3</a></li>
		</ul>
	</div>
	<div class="tab-body-wrapper">
		<div class="tab-body" id="tab1"><p>Body 1</p></div>
		<div class="tab-body tab-body-hidden" id="tab2"><p>Body 2</p></div>
		<div class="tab-body tab-body-hidden" id="tab3"><p>Body 3</p></div>
	</div>
	</div>
</body>
