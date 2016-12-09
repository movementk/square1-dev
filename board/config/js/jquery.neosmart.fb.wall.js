/************************************************************************************************************************************
 *	fb.wall				Facebook Wall jQuery Plguin
 *
 *	@author:			Daniel Benkenstein / neosmart GmbH
 *	@version:			1.2.7
 *	@Last Update:		06.06.2011
 *	@licence:			MIT (http://www.opensource.org/licenses/mit-license.php)
 *						GPL	(http://www.gnu.org/licenses/gpl.html)
 *	@documentation:		http://www.neosmart.de/social-media/facebook-wall
 *	@feedback:			http://www.neosmart.de/blog/jquery-plugin-facebook-wall
 *	
 ************************************************************************************************************************************/

(function($) {
	
	$.fn.fbWall = function(options) {
		
		var opts = $.extend({}, $.fn.fbWall.defaults, options);
		var meta = this;
		
		return meta.each(function() {
			$this = $(this);
			var o = $.meta ? $.extend({}, opts, $this.data()) : opts;
			var output = '';
			var avatarBaseURL;
			var baseData;
			var graphURL = "https://graph.facebook.com/";
			
			/******************************************************************************************************
			 * Load base data
			 ******************************************************************************************************/
			 
			meta.addClass('fb-wall').addClass('loading').html('');
			$.ajax({
				url: graphURL+o.id+'?access_token='+o.accessToken,
				dataType: "jsonp",
				success: function(data, textStatus, XMLHttpRequest){
					initBase(data);
				}
			});
			
			/******************************************************************************************************
			 * Load feed data
			 ******************************************************************************************************/
			 
			var initBase = function(data){
				baseData = data;
				
				if(data==false){
					meta.removeClass('loading').html('The alias you requested do not exist: '+o.id);
					return false;
				};
				
				if(data.error){
					meta.removeClass('loading').html(data.error.message);
					return false;
				};
				
				var type = (o.showGuestEntries=='true'||o.showGuestEntries==true) ? 'feed' : 'posts';
				$.ajax({
					url: graphURL+o.id+"/"+type+"?limit="+o.max+'&access_token='+o.accessToken,
					dataType: "jsonp",
					success:function (data, textStatus, XMLHttpRequest) {
						meta.removeClass('loading');
						initWall(data);
					}
				});
			}
	
			/******************************************************************************************************
			 * Parse feed data / wall
			 ******************************************************************************************************/
			 
			var initWall = function(data){
				
				data = data.data;
				
				var max = data.length;
				var thisAvatar, isBase, hasBaseLink, thisDesc;
				
				for(var k=0;k<max;k++){

					// Shortcut ------------------------------------------------------------------------------------------------------------------------------
					isBase = (data[k].from.id==baseData.id);
					hasBaseLink = isBase&&(exists(baseData.link));
					if(!o.showGuestEntries&&!isBase) continue;
					
					// Box -----------------------------------------------------------------------------------------------------------------------------------


/*
					output += (k==0) ? '<div class="fb-wall-box fb-wall-box-first">' : '<div class="fb-wall-box">';
					output += '<a href="http://www.facebook.com/profile.php?id='+data[k].from.id+'" target="_blank">';
					output += '<img class="fb-wall-avatar" src="'+getAvatarURL(data[k].from.id)+'" />';
					output += '</a>';
					output += '';
					
					output += '<span class="fb-wall-message">';
					output += '<a href="http://www.facebook.com/profile.php?id='+data[k].from.id+'" style="font-weight:bold;color:#3B5998;" target="_blank">'+data[k].from.name+'</a><br> ';
					if(exists(data[k].message)) output += modText(data[k].message);
					output += '</span>';

*/		




				//	output += (k==0) ? '<table width=160><tr>' : '';
					output += '<table width=140>';
					output +=	'<tr>';
					output +=		'<td style="clear:both;padding-top:5px;padding-left:5px;" valign=top><img src="'+getAvatarURL(data[k].from.id)+'" /></td>';
					output +=		'<td style="padding-top:5px;padding-left:5px;">';
					output +=			'<table cellpadding="0" cellspacing="0" style="border: 1px solid #c7d7dd;" width=90>';
					output +=				'<tr>';
					output +=					'<td style="padding-left:5px;"><a href="http://www.facebook.com/profile.php?id='+data[k].from.id+'" style="color:#2eb2fe;" target="_blank">'+data[k].from.name+'</a></td>';
					output +=				'</tr>';
					output +=				'<tr>';
					output +=					'<td style="padding-left:5px;word-break:break-all;">';
					if(exists(data[k].message)) output += modText(data[k].message);
					output +=					'</td>';
					output +=				'</tr>';
//					output +=				'<tr>';
//					output +=					'<td align=right style="padding-right:10px;padding-left:5px;word-break:break-all;">';
//					output += formatDate(data[k].created_time);		
//					output +=					'</td>';
//					output +=				'</tr>';
					output +=			'</table>';
					output +=		'</td>';
					output +=	'</tr>';
					output += '</table>';

					// Media -----------------------------------------------------------------------------------------------------------------------------------

					if(exists(data[k].picture)||exists(data[k].link)||exists(data[k].caption)||exists(data[k].description)){
						output += '<div style="padding-left:65px;width:90px">';
						output += exists(data[k].picture) ? '<div class="fb-wall-media" style="border: 1px solid #c7d7dd">' : '<div class="fb-wall-media fb-wall-border-left"  >';
						if(exists(data[k].picture)){
							if(exists(data[k].link)) output += '<a href="'+data[k].link+'" target="_blank" class="fb-wall-media-link">';
							output += '<img class="fb-wall-picture" src="'+data[k].picture+'" />';
							if(exists(data[k].link)) output += '</a>';
						}
						output += '<div class="fb-wall-media-container" style="word-break:break-all;width:90px;" >';
						if(exists(data[k].name)) output += '<a class="fb-wall-name" href="'+data[k].link+'" target="_blank">'+data[k].name+'</a>';
						if(exists(data[k].caption)) output += '<a class="fb-wall-caption" href="http://'+data[k].caption+'" target="_blank">'+data[k].caption+'</a>';
						if(exists(data[k].properties)){
							for(var p=0;p<data[k].properties.length;p++) output += (p==0) ? '<div style="width:40px;word-break:break-all;">'+formatDate(data[k].properties[p].text)+'</div>' : '<div style="width:40px;word-break:break-all;">'+data[k].properties[p].text+'</div>';
						}
						if(exists(data[k].description)){
							thisDesc = modText(data[k].description);
							if(thisDesc.length>299)thisDesc=thisDesc.substr(0,thisDesc.lastIndexOf(' '))+' ...';
							output += '<span class="fb-wall-description">'+thisDesc+'</span>';
						}
						output += '</div>';
						output += '</div>';
						output += '</div>';
					}
				//	output += '<br><span class="fb-wall-date">';
				//	if(exists(data[k].icon)) output += '<img class="fb-wall-icon" src="'+data[k].icon+'" title="'+data[k].type+'" alt="" />';
				//	output += formatDate(data[k].created_time)+'</span>';		
					

					// Likes -------------------------------------------------------------------------------------------------------------------------------
					if(exists(data[k].likes)){
						if(parseInt(data[k].likes.count)==1){
							output += '<div class="fb-wall-likes"><div><span>'+data[k].likes.data[0].name+'</span> '+o.translateLikesThis+'</div> </div>';
						} else {
							output += '<div class="fb-wall-likes"><div><span>'+data[k].likes.count+' '+o.translatePeople+'</span> '+o.translateLikeThis+'</div> </div>';
						}
					}
					
					// Comments -------------------------------------------------------------------------------------------------------------------------------
					if(exists(data[k].comments) && exists(data[k].comments.data) && (o.showComments==true||o.showComments=='true')){
						
						output += '<table width=140 border=0>';
						for(var c=0;c<data[k].comments.data.length;c++){
						output +=	'<tr>';
						output +=		'<td style="width:80px;">&nbsp;</td>';
						output +=		'<td style="clear:both;padding-top:5px;padding-left:5px;" valign=top><img src="'+getAvatarURL(data[k].comments.data[c].from.id)+'" /></td>';
						output +=		'<td style="padding-top:5px;padding-left:5px;">';
						output +=			'<table cellpadding="0" cellspacing="0" style="border: 1px solid #c7d7dd;" width=40>';
						output +=				'<tr>';
						output +=					'<td style="padding-left:5px;"><a href="http://www.facebook.com/profile.php?id='+data[k].comments.data[c].from.id+'" style="color:#2eb2fe;" target="_blank">'+data[k].comments.data[c].from.name+'</a></td>';
						output +=				'</tr>';
						output +=				'<tr>';
						output +=					'<td style="padding-left:5px;word-break:break-all;">';
						if(exists(data[k].comments.data[c].message)) output += modText(data[k].comments.data[c].message);
						output +=					'</td>';
						output +=				'</tr>';
						output +=				'<tr>';
						output +=					'<td align=right style="padding-right:10px;padding-left:5px;">';
						output += formatDate(data[k].comments.data[c].created_time)+'</span>';		
						output +=					'</td>';
						output +=				'</tr>';
						output +=			'</table>';
						output +=		'</td>';
						output +=	'</tr>';
						}
						output += '</table>';
					}
					
					output += '<div class="fb-wall-clean"></div>';
				//	output += '</div>';
				}
				
				// No data found --------------------------------------------------------------------------------------------
				if(max==0){
					output += '<div class="fb-wall-box-first">';
					output += '<img class="fb-wall-avatar" src="'+getAvatarURL(baseData.id)+'" />';
					output += '<div class="fb-wall-data">';
					output += '<span class="fb-wall-message"><span style="font-weight:bold;color:#3B5998;">'+baseData.name+'</span> '+o.translateErrorNoData+'</span>';
					output += '</div>';
					output += '</div>';
				}
				meta.hide().html(output).fadeIn(700);
			}
			
			/******************************************************************************************************
			 * Get Avatar URLs
			 ******************************************************************************************************/
			
			function getAvatarURL(id){
				var avatarURL;
				if(id==baseData.id){ avatarURL = (o.useAvatarAlternative) ? o.avatarAlternative : graphURL+id+'/picture?type=square'; }
				else{ avatarURL = (o.useAvatarExternal) ? o.avatarExternal : graphURL+id+'/picture?type=square'; }
				return avatarURL;
			}
						
			/******************************************************************************************************
			 * Parse dateStr as formatted date
			 * @return: if dateStr can't be parsed as Date, return dateStr
			 ******************************************************************************************************/
			 
			function formatDate(dateStr){
			//alert(dateStr)
				var year, month, day, hour, minute, dateUTC, date, ampm, d, time;
				var iso = (dateStr.indexOf(' ')==-1&&dateStr.substr(4,1)=='-'&&dateStr.substr(7,1)=='-'&&dateStr.substr(10,1)=='T') ? true : false;

				if(iso){
					year = dateStr.substr(0,4);
					month = parseInt((dateStr.substr(5,1)=='0') ? dateStr.substr(6,1) : dateStr.substr(5,2))-1;
					day = dateStr.substr(8,2);
					hour = dateStr.substr(11,2);
					minute = dateStr.substr(14,2);
					dateUTC = Date.UTC(year, month, day, hour, minute);
				
					date = new Date(dateUTC);
				}else{
					d = dateStr.split(' ');
					if(d.length!=6||d[4]!='at')
						return dateStr;
					time = d[5].split(':');
					ampm = time[1].substr(2);
					minute = time[1].substr(0,2);
					hour = parseInt(time[0]);
					if(ampm=='pm')hour+=12;
					date = new Date(d[1]+' '+d[2]+' '+d[3] +' '+ hour+':'+minute);
					date.setTime(date.getTime()-(1000*60*60*7));
				}
				day = (date.getDate()<10)?'0'+date.getDate():date.getDate();
				month = date.getMonth()+1;
				month = (month<10)?'0'+month:month;
				hour = date.getHours();
				minute = (date.getMinutes()<10)?'0'+date.getMinutes():date.getMinutes();
				if(o.timeConversion==12){
					ampm = (hour<12) ? 'am' : 'pm';
					if(hour==0)hour==12;
					else if(hour>12)hour=hour-12;
					if(hour<10)hour='0'+hour;
					return day+'.'+month+'.'+date.getFullYear()+' at '+hour+':'+minute+' '+ampm;
				}
//				return day+'.'+month+'.'+date.getFullYear()+' '+o.translateAt+' '+hour+':'+minute;
				return date.getFullYear()+'년 '+month+'월 '+day+'일 '+hour+':'+minute;
			}
		
			/******************************************************************************************************
			 * Helper Function
			 ******************************************************************************************************/
			 
			function exists(data){
				if(!data || data==null || data=='undefined' || typeof(data)=='undefined') return false;
				else return true;
			}
			
			function modText(text){
				return nl2br(autoLink(escapeTags(text)));
			}
			
			function escapeTags(str){
				return str.replace(/</g,'&lt;').replace(/>/g,'&gt;');
			}
			
			function nl2br(str){
				return str.replace(/(\r\n)|(\n\r)|\r|\n/g,"<br>");
			}
			
			function autoLink(str){
				return str.replace(/((http|https|ftp):\/\/[\w?=&.\/-;#~%-]+(?![\w\s?&.\/;#~%"=-]*>))/g, '<a href="$1" target="_blank">$1</a>');
			}

		});
	};

	/******************************************************************************************************
	 * Defaults 
	 ******************************************************************************************************/
	 
	$.fn.fbWall.defaults = {
		avatarAlternative:		'avatar-alternative.jpg',
		avatarExternal:			'avatar-external.jpg',
		id: 					'100002169446562',
		max:					5,
		showComments:			true,
		showGuestEntries:		true,
		translateAt:			'at',
		translateLikeThis:		'like this',
		translateLikesThis:		'likes this',
		translateErrorNoData:	'has not shared any information.',
		translatePeople:		'people',
		timeConversion:			24,
		useAvatarAlternative:	false,
		useAvatarExternal:		false,
		accessToken:			'206158599425293|3842d5a87faf66729e007262.1-100001735201571|NqD3BMETEfhr-38sdGx0sqdBSEs'
	};

})(jQuery);