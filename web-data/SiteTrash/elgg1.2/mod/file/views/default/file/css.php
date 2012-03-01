<?php
	/**
	 * File CSS extender
	 * 
	 * @package Elgg File Repository
	 * @copyright Curverider Ltd 2008
	 * @link http://elgg.com/
	 */
?>

p.filerepo_owner {
	margin:0;
	padding:0;
}
.filerepo_owner_details {
	/* font-size: 90%; */
	margin:0;
	padding:0;
	line-height: 1.2em;
}
.filerepo_owner_details small {
	color:#666666;
}
.filerepo_owner .usericon {
	margin-right: 5px;
	float: left;
}

.filerepo_download a {
	font: 12px/100% Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #ffffff;
	background:#4690d6;
	border: 1px solid #4690d6;
	-webkit-border-radius: 3px; 
	-moz-border-radius: 3px;
	width: auto;
	height: 25px;
	padding: 2px 6px 2px 6px;
	margin:10px 0 10px 0;
	cursor: pointer;
}

.filerepo_download a:hover {
	background: #0054a7;
	text-decoration: none;
}

/* FILE REPRO WIDGET VIEW */
.filerepo_widget_singleitem {
	background-color: #eeeeee;
	margin:0 0 10px 0;
	min-height:60px;
	display:block;
}
.filerepo_listview_icon {
	float: left;
	margin-right: 10px;
}
.filerepo_timestamp {
	color:#666666;
	margin:0;
}
.filerepo_listview_desc {
	display:none;
	padding:0 5px 10px 0;
	line-height: 1.2em;
}
.filerepo_widget_content {
	margin-left: 70px;
}
.filerepo_title {
	margin:0;
	padding:6px 5px 0 0;
	line-height: 1.2em;
}

.collapsable_box #filerepo_widget_layout {
	margin:0;
}

/* widget gallery view */
.filerepo_widget_galleryview img {
	padding:2px;
    border:1px solid #efefef;
    margin:2px;
}

/* SINGLE ITEM VIEW */
.filerepo_file {
	margin-bottom: 50px;
}
.filerepo_file .filerepo_title_owner_wrapper {
	min-height:60px;
	background-color: #eeeeee;
}
.filerepo_title_owner_wrapper .filerepo_title,
.filerepo_title_owner_wrapper .filerepo_owner {
	margin-left: 70px !important;
}
.filerepo_file .filerepo_maincontent {
	margin-left: 70px;
}
.filerepo_file .filerepo_icon {
	width: 70px;
	position: absolute;
	background-color: #eeeeee;
}
.filerepo_file .filerepo_title {
	margin:0;
	padding:1px 4px 5px 10px;
	line-height: 1.2em;
}
.filerepo_file .filerepo_owner {
	padding:0 0 0 10px;
}
.filerepo_file .filerepo_description {
	margin:10px 0 0 0;
	padding:0 0 0 10px;
}
.filerepo_download,
.filerepo_controls {
	padding:0 0 0 10px;
	margin:0;
}
.filerepo_file .filerepo_description p {
	padding:0 0 5px 0;
	margin:0;
}
.filerepo_file .filerepo_specialcontent img {
	padding:5px;
	margin:0 0 0 10px;
	border:1px dotted silver; 
}
.filerepo_tags {
	padding:0 0 10px 10px;
	margin:0;
}

/* file repro gallery items */
.search_gallery .filerepo_controls {
	padding:0;
}
.search_gallery .filerepo_title {
	font-weight: bold;
	line-height: 1.1em;
	margin:0 0 10px 0;
}

.filerepo_gallery_item {
	margin:0;
	padding:0;
}
.filerepo_gallery_item p {
	margin:0;
	padding:0;
}
.search_gallery .filerepo_comments {
	font-size:90%;
}

.filerepo_user_gallery_link {
	float:right;
	margin:5px 5px 5px 50px;
}
.filerepo_user_gallery_link a {
	padding:2px 25px 5px 0;
	background: transparent url(<?php echo $vars['url']; ?>_graphics/icon_gallery.gif) no-repeat right top;
	display:block;
}
.filerepo_user_gallery_link a:hover {
	background-position: right -40px;
}
