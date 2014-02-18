<!-- application/layouts/scripts/layout.phtml -->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Mokation Quickstart Application</title>

	<link href="/css/styles.css" rel="stylesheet">
	<link href="/css/sprite.css" rel="stylesheet">

	<title ng-bind="$root.title">Deezer Light</title>

	<script src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.8.3.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.js"></script>
	<script src="/js/controllers.js"></script>

	<style type="text/css">

	* {
		margin:0;
		padding:0;
	}
	#wrapper
	{
		min-width:960px;
		margin-left:auto;
		margin-right:auto;
	}
	#top
	{
		width: 100%;
		height: 30px;
		background-image: url("/images/diagonal_lines.png");
	}
	#top b{
		color: #fff;
		margin-left: 10px;
	}
	#content
	{
		min-width:400px;
		margin-right: -210px;
		width:900px;
		float:left;
		background-color:#fff;
	}

	#left
	{
		width:110px;
		float:left;
		margin-left:1px;
		background-color: #ccc;
		height: 600px;
	}
	#left ul {
		widht:110px;
		padding:3px;
		margin:0;  
	}

	#left li {
		list-style: none;
		padding:3px 5px;
		background:#666666;
		margin-bottom:2px;
		font: 12px verdana, arial, helvetiva, sans-serif;
	}

	#left li a {
		display:block;
		color: #ffffff;
		text-decoration: none;
	}
	#left li a:visited {
		color: #ffffcc;
	}
	#left li a:hover {
		color: #000000;
		background-color:#ffffff;
	}

	</style>

</head>
<body>

	<div id="wrapper">
		<div id="top"><b>Mokation</b></div>
		<div class="horizontalSpacer"></div>
		<div id="left">
			<ul>
				<li>
					<a href="/index/radio">Radio</a>
				</li>

			</ul>
		</div>
		<div id="content">
			
			<div ng-app="app">

				<div class="app" ng-controller="AppController">

					<div id="header">
						<div id="controls">
							<div id="controls_inner">
								<button class="ctn_btn sprite btn_prev" id="previous" ng-click="previous()"></button>
								<button class="ctn_btn sprite btn_play" id="play" ng-click="play()" ng-show="!playing"></button>
								<button class="ctn_btn sprite btn_pause" id="pause" ng-click="pause()" ng-show="playing"></button>
								<button class="ctn_btn sprite btn_next" id="next" ng-click="next()"></button>
							</div>
						</div>

						<div id="playing">
							<div id="playing_meta" my-current-time>
								<div id="playing_author"><a ng-href="{{playing_artist_link}}" class="meta_link">{{playing_artist}}</a>&nbsp;</div>
								<div id="playing_title"><a ng-href="{{playing_album_link}}" class="meta_link">{{playing_title}}</a>&nbsp;</div>
							</div>
							<div id="times">
								<span id="time_current" ng-show="logged">{{time_current | humain_time}}&nbsp;</span>
								<span id="time_total" ng-show="logged">{{time_total | humain_time}}&nbsp;</span>
								<div id="slider" ng-click="sliderClicked($event)">
									<div id="progress" ng-style="{'width': (time_current / time_total * 100) + '%'}"><div class="inline" id="progress_hand"></div></div>
								</div>
							</div>
						</div>

						<div id="search">
							<input type="text" placeholder="Artist, album, track" id="search_input" ng-model="search_value" on-keyup-search>
						</div>

						<div id="cover">
							<a ng-href="{{playing_album_link}}" id="cover_link" ng-show="playing &amp;&amp; playing_cover_src"><img ng-src="{{playing_cover_src}}" width="80" height="80" class="inline" id="cover_image" /></a>
						</div>
					</div>

					<div id="wrapper" class="layoutWrapper">

						<div id="content">
							<div id="menu">
								<a href="#/playlists" class="link_tabs" ng-class="{active: view == 'playlists'}">My playlists</a>
								<a href="#/albums" class="link_tabs" ng-class="{active: view == 'albums'||view == 'album'}">Albums</a>
								<a href="#/artists" class="link_tabs" ng-class="{active: view == 'artists'}">Artists</a>
								<a href="#/favorites" class="link_tabs" ng-class="{active: view == 'favorites'}">Favorites</a>
							</div>

							<div ng-show="view == 'login'" class="loader">
								<div class="loader_content">
									<a class="login_link" ng-click="login()">Connect with Deezer</a></div>
								</div>

								<div ng-show="view == 'loading'" class="loader">
									<div class="loader_content">loading...</div>
								</div>

								<div ng-show="view == 'playlists'">
									<div ng-repeat="playlist in playlists" class="inline grid_list">
										<a href="#/playlist/{{playlist.id}}">
											<img class="cover" src="{{playlist.picture}}?size=big" width="160" height="160">
											<div class="grid_title">{{playlist.title}}</div>
										</a>
									</div>
									<div class="clear"></div>
								</div>

								<div ng-show="view == 'playlist'">
									<div class="album_cover_view">
										<img src="{{playlist.picture}}?size=big" width="100%" height="100%">
										<h3>{{playlist.title}}</h3>
									</div>

									<div class="album_track_list">
										<table class="table_tracks">
											<tr ng-repeat="track in playlist.tracks.data">
												<td><a class="link_track" ng-click="play_track($index)">{{track.title}}</a></td>
												<td style="text-align:right;"><a href="#/artist/{{track.artist.id}}">{{track.artist.name}}</a></td>
											</tr>
										</table>
									</div>
									<div class="clear"></div>
								</div>

								<div ng-show="view == 'albums'">
									<div ng-repeat="album in albums" class="inline grid_list">
										<a href="#/album/{{album.id}}">
											<img class="cover" src="{{album.cover}}?size=big" width="160" height="160">
											<div class="grid_title">{{album.title}}</div>
										</a>
									</div>
									<div class="clear"></div>
								</div>

								<div ng-show="view == 'album'" class="playlists">
									<div class="album_cover_view">
										<img src="{{album.cover}}?size=big" width="100%" height="100%">
										<h3>{{album.title}}</h3>
										<h4>{{album.artist.name}}</h4>
									</div>

									<div class="album_track_list">
										<table class="table_tracks">
											<tr ng-repeat="track in album.tracks.data">
												<td><a class="link_track" ng-click="play_track($index)">{{track.title}}</a></td>
												<td style="text-align:right;"><a href="#/artist/{{track.artist.id}}">{{track.artist.name}}</a></td>
											</tr>
										</table>
									</div>
									<div class="clear"></div>
								</div>

								<div ng-show="view == 'artists'">
									<div ng-repeat="artist in artists" class="inline grid_list">
										<a href="#/artist/{{artist.id}}">
											<img class="cover" src="{{artist.picture}}?size=big" width="160" height="160">
											<div class="grid_title">{{artist.name}}</div>
										</a>
									</div>
									<div class="clear"></div>
								</div>

								<div ng-show="view == 'artist'">
									<h3>{{artist.name}}</h3>
									<div ng-repeat="album in albums" class="inline grid_list">
										<a href="#/album/{{album.id}}">
											<img class="cover" src="{{album.cover}}?size=big" width="160" height="160">
											<div class="grid_title">{{album.title}}</div>
										</a>
									</div>
									<div class="clear"></div>
								</div>

								<div ng-show="view == 'favorites'">
									<div>
										<table class="table_tracks">
											<tr ng-repeat="track in favorites">
												<td><a class="link_track" ng-click="play_track($index)">{{track.title}}</a></td>
												<td><a href="#/album/{{track.album.id}}">{{track.album.title}}</a></td>
												<td style="text-align:right;"><a href="#/artist/{{track.artist.id}}">{{track.artist.name}}</a></td>
											</tr>
										</table>
									</div>
									<div class="clear"></div>
								</div>

								<div ng-show="view == 'search'">
									<div>
										<div ng-show="search_tracks.length == 0 &amp;&amp; search_artists.length == 0 &amp;&amp; search_albums.length == 0" class="loader">
											<div class="loader_content">No result :(</div>
										</div>

										<table class="table_tracks">
											<tr ng-repeat="track in search_tracks">
												<td><a class="link_track" ng-click="play_track_id(track.id)">{{track.title}}</a></td>
												<td><a href="#/album/{{track.album.id}}">{{track.album.title}}</a></td>
												<td style="text-align:right;"><a href="#/artist/{{track.artist.id}}">{{track.artist.name}}</a></td>
											</tr>
										</table>

										<div ng-repeat="artist in search_artists" class="grid_list_small">
											<a href="#/artist/{{artist.id}}">
												<img src="{{artist.picture}}" width="120" height="120">
												<div class="grid_title">{{artist.name}}</div>
											</a>
										</div>

										<div ng-repeat="album in search_albums" class="grid_list_small">
											<a href="#/album/{{album.id}}">
												<img src="{{album.cover}}" width="120" height="120">
												<div class="grid_title">{{album.title}}</div>
											</a>
										</div>
									</div>
									<div class="clear"></div>
								</div>

								<div class="clear"></div>
							</div>
						</div>

						<div id="dz-root"></div>
						<script src="http://cdn-files.deezer.com/js/min/dz.js"></script>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>