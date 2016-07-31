import java.io.*;
import javax.servlet.*;
import javax.servlet.http.*;
import java.util.*;

public class Details extends HttpServlet{
 
   @Override
   public void doGet(HttpServletRequest request, HttpServletResponse response)
               throws IOException, ServletException {
      
		response.setContentType("text/html; charset=UTF-8");
		PrintWriter out = response.getWriter();
 
		try {
			
			String[][] details = new String[][]{
				{"","",""},
				{"Too Weird To Live, Too Rare To Die","Panic! at the Disco",
					" Too Weird to Live, Too Rare to Die! is the fourth studio album by American rock band Panic! at the Disco, released on October 8, 2013 on Decaydance and Fueled by Ramen. Recorded as a three-piece, the album was produced by Butch Walker, and is the first to feature bass guitarist Dallon Weekes, who initially joined the band in 2009 as its touring bassist. Described as a 'party record,' Too Weird to Live, Too Rare to Die! was preceded by the singles, 'Miss Jackson', 'This Is Gospel' and 'Girls/Girls/Boys'. The album's overall aesthetic is influenced by dance music, electronica and hip-hop. Too Weird to Live, Too Rare to Die! debuted at number two on the U.S. Billboard 200, earning the band their second career number two.<h4>Tracks on the Album:</h4><ol id='albumTracks'><li>This is Gospel</li><li>Miss Jackson</li><li>Vegas Lights</li><li>Girl That You Love</li><li>Nicotine</li><li>Girls/Girls/Boys</li><li>Casual Affair</li><li>Far Too Young To Die</li><li>Collar Full</li><li>The End of All Things</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Too_Weird_to_Live,_Too_Rare_to_Die!' target='_blank'>Wikipedia</a></div>"},
				{"Overnight","Parachute",
					"Overnight is the third studio album of the American pop rock band Parachute. Released on August 13, 2013, the album continuously topped the iTunes top ten album charts, reaching the #3 spot, on its first week of release. Overnight also marked the band's highest chart position, reaching fifteen on the US Billboard 200. Their lead single 'Can't Help', which aimed to go all-in for pop dominance, was co-written by OneRepublic's Ryan Tedder. In the summer of 2013, the band went out on a nationwide tour in support of their new album. <h4>Tracks on the Album:</h4><ol id='albumTracks'><li>Meant to Be</li><li>Can't Help</li><li>Drive You Home</li><li>Hurricane</li><li>Overnight</li><li>Didn't See It Coming</li><li>The Other Side</li><li>Waiting for That Call</li><li>The Only One</li><li>Disappear</li><li>Higher</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Parachute_(band)' target='_blank'> Wikipedia </a> & <a href='http://www.idolator.com/7477134/parachute-overnight-review' target='_blank'> Idolator </a></div>"},
				{"Lights","Ellie Goulding",
					"Lights is the debut studio album by English recording artist Ellie Goulding, released on 26 February 2010 by Polydor Records. The album received generally positive reviews from music critics, who complimented Goulding's electronic edge, while less favourable reviews felt the sound was generic. Lights debuted atop the UK Albums Chart with first-week sales of 36,854 copies. In North America, the album charted at number twenty-one in the United States and number sixty-six in Canada. It spawned four singles: 'Under the Sheets', 'Starry Eyed', 'Guns and Horses' and 'The Writer'. The album was re-released on 29 November 2010 as Bright Lights, including six brand-new tracks. It produced two additional singles, those being a cover of Elton John's 'Your Song' and 'Lights', which became Goulding's biggest hit to date in the UK and US, respectively.<h4>Tracks on the Album:</h4><ol id='albumTracks'><li>Guns and Horses</li><li>Starry Eyed</li><li>This Love(Will Be Your Downfall)</li><li>Under the Sheets</li><li>The Writer</li><li>Every Time You Go</li><li>Wish I Stayed</li><li>Your Biggest Mistake</li><li>I'll Hold My Breath</li><li>Salt Skin</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Lights_(Ellie_Goulding_album)' target='_blank'> Wikipedia </a></div>"},
				{"Wonders of the Younger","Plain White T's",
					"Wonders of the Younger, the sixth album by the band Plain White T's was released on December 7, 2010. The collection of the songs was designed to evoke the feeling of awe and the yearning for adventure remembered from youth. 'Rhythm of Love' is the first single from Plain White T's'studio album. Higgenson noted that the song is all about pushing the boundaries of their creativity and musical imagination combined with a dose of nostalgia. <h4>Tracks on the Album:</h4><ol id='albumTracks'><li>Irrational Anthem</li><li>Boomerang</li><li>Welcome to Mystery</li><li>Rhythm of Love</li><li>Map of the World</li><li>Killer</li><li>Last Breath</li><li>Broken Record</li><li>Our Song</li><li>Airplane</li><li>Cirque Dans La Rue</li><li>Body Parts</li><li>Make It Up As You Go</li><li>Wonders of the Younger</li><li>Thanks for Nothing(Bonus)</li><li>Hollywood Love(Bonus)</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Wonders_of_the_Younger' target='_blank'> Wikipedia </a></div>"},
				{"On Letting Go","Circa Survive",
					"On Letting Go is the second album by American rock band Circa Survive. Released on May 29, 2007, by Equal Vision Records, the album entered the U.S. Billboard 200 at number 24, selling about 24,000 copies in its first week. As of July 11, 2007, it had sold 51,357 copies in the US.<h4>Tracks on the Album</h4><ol id='albumTracks'><li>Living Together</li><li>In the Morning and Amazing...</li><li>The Greatest Lie</li><li>The Difference Between Medicine and Poison is in the Dose</li><li>Mandala</li><li>Travel Hymn</li><li>Semi Constructive Criticism</li><li>Kicking Your Crosses Down</li><li>On Letting Go</li><li>Carry Us Away</li><li>Close Your Eyes to See</li><li>Your Friends Are Gone</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/On_Letting_Go' target='_blank'> Wikipedia </a></div>"},
				{"Stars - Some Nights","fun.",
					"Stars is the 10th/last song in fun's album Some Nights. It is a seven-minute song that segues from an upbeat into a long coda of hot-tar guitar licks trading off with Ruess' increasingly distorted voice singing 'You're always holding on to stars,' over and over until the song eventually drops out. <div id='source'>Source:<a href='http://www.spin.com/reviews/fun-some-nights-fueled-ramen/' target='_blank'>Spin</a></div>"},
				{"Nicotine - Too Weird To Live, Too Rare to Die","Panic! at the Disco",
					"Nicotine is the 5th track in Panic! At the Disco's album Too Weird to Live, Too Rare to Die. Despite being described as a dark track - the twinkly keys, pace-setting drums, and sneaky guitar lines - it's chorus 'You're worse than nicotine' is still one of the strongest on the record. <div id='source'>Source:<a href='http://www.absolutepunk.net/showthread.php?t=3469161' target='_blank'>Absolute Punk</a></div>"},
				{"The Greatest Lie - On Letting Go","Circa Survive",
					"The Greatest Lie, the 3rd track in Circa Survive's album On Letting Go showcased the band's strength in tricky drumming, otherworldly vocals, and esoteric lyrics. The track starts easily and then thunder into squealing choruses. <div id='source'>Source:<a href='http://www.altpress.com/reviews/entry/onlettinggo' target='_blank'>Alternative Press</a></div>"},
				{"Hurricane - Overnight","Parachute",
					"Hurricane is the 4th track in Parachute's album Overnight. One of the slower jams in the album, it displays Parachute's attempt to explore more creative sides of pop music. <div id='source'>Source:<a href='http://idobi.com/news/2013/08/parachute-overnight-album-review/' target='_blank'>Idobi</a></div>"},
				{"Broken Record - Wonders of the Younger","Plain White T's",
					"Broken Record is the 8th track in the album Wonders of the Younger of the American pop punk band Plain White T's. A catchy track subtly influenced by the 60s, lead singer Tom Higgenson dedicates this song to his past lover for being 'stuck in his head like a broken record.' <div id='source'>Source:<a href='http://www.contactmusic.com/album-review/plain-white-ts-wonders-of-the-younger' target='_blank'>Contactmusic</a></div>"},
				{"Pure Heroine","Lorde",
					"Pure Heroine is the debut studio album by New Zealand singer-songwriter Lorde. It was first released on 27 September 2013 with an extended version of the album being released on 13 December 2013. Consisting of ten tracks, 'Pure Heroine' is an art pop and electronica album, combining ambient, dark wave, indietronica and synthpop genres with minimalist production, lyrically thought-provoking song structure and striking vocals. The lead single, 'Royals', was a critical and commercial success, topping the charts in Canada, Ireland, the United Kingdom and the United States. 'Tennis Court' and 'Team' were subsequently released as the second and third singles from the album and have enjoyed moderate commercial success as well, charting in multiple countries. Pure Heroine is nominated for Best Pop Vocal Album at the 56th Annual Grammy Awards, while 'Royals' is nominated for Record of the Year, Song of the Year and Best Pop Solo Performance.<h4>Tracks on the Album</h4><ol id='albumTracks'><li>Tennis Court</li><li>400 Lux</li><li>Royals</li><li>Ribs</li><li>Buzzcut Season</li><li>Team</li><li>Glory and Gore</li><li>Still Sane</li><li>White Teeth Teens</li><li>A World Alone</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Pure_Heroine' target='_blank'> Wikipedia </a></div>"},
				{"Native","OneRepublic",
					"Native is the third studio album by American band OneRepublic. It was released on March 22, 2013 in Germany and Ireland, March 25 worldwide except North America, and March 26 in North America. 'If I Lose Myself' was released as the lead single for the album. It has since spawned the very successful single 'Counting Stars', peaking at number 3 so far on the Billboard Hot 100, becoming their first Top 10 hit since 'Good Life' in 2010.<h4>Tracks on the Album</h4><ol id='albumTracks'><li>Counting Stars</li><li>If I Lose Myself</li><li>Feel Again</li><li>What You Wanted</li><li>I Lived</li><li>Light It Up</li><li>Can't Stop</li><li>Au Revoir</li><li>Burning Bridges</li><li>Something I Need</li><li>Preacher</li><li>Don't Look Down</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Native_(album)' target='_blank'> Wikipedia </a></div>"},
				{"A.M.","Arctic Monkeys",
					"AM is the fifth studio album by the English indie rock band Arctic Monkeys. Produced by James Ford and co-produced by Ross Orton, it was released in September 2013 through Domino. The album was promoted by the singles: 'R U Mine?', 'Do I Wanna Know?', 'Why'd You Only Call Me When You're High?' and 'One for the Road'. It features guest appearances by Josh Homme, Bill Ryder-Jones and Pete Thomas. The album received widespread critical acclaim. It was nominated for the 2013 Mercury Prize for best album, hailed the Best Album of 2013 by NME magazine, and featured at number 449 on NME's list of the 500 Greatest Albums of All Time. Commercially, AM has become Arctic Monkeys' most successful album to date, topping charts in several countries, and reaching top 10 positions in many more. <h4>Tracks on the Album</h4><ol id='albumTracks'><li>Do I Wanna Know?</li><li>R U Mine?</li><li>One for the Road</li><li>Arabella</li><li>I Want It All</li><li>No. 1 Party Anthem</li><li>Mad Sounds</li><li>Fireside</li><li>Why'd You Only Call Me When You're High?</li><li>Snap Out of It</li><li>Knee Socks</li><li>I Wanna Be Yours</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/AM_(Arctic_Monkeys_album)' target='_blank'> Wikipedia </a></div>"},
				{"Bangerz","Miley Cyrus",
					"Bangerz is the fourth studio album by American recording artist Miley Cyrus, released on October 4, 2013 by RCA Records. Described by Cyrus as 'dirty south hip-hop', Bangerz represents a musical departure from her earlier work, which she has grown to feel 'disconnected' from. The lead single 'We Can't Stop' was released on June 3, 2013, and peaked at number two on the US Billboard Hot 100. The second single 'Wrecking Ball' was released on August 25, 2013, and became Cyrus' first single to peak in the top position in the United States. Its accompanying music video currently holds the Vevo record for most views in the first 24 hours of its release, and the record for being the fastest video to reach 100 million views on the service. 'Adore You' was serviced as the third single from the record on December 17, 2013.<h4>Tracks on the Album</h4><ol id='albumTracks'><li>Adore You</li><li>We Can't Stop</li><li>SMS (Bangerz)</li><li>4x4</li><li>My Darlin</li><li>Wrecking Ball</li><li>Love Money Party</li><li>#Getitright</li><li>Drive</li><li>FU</li><li>Do My Thang</li><li>Maybe You're Right</li><li>Someone Else</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Bangerz_(album)' target='_blank'> Wikipedia </a></div>	"},
				{"Midnight Memories","One Direction",
					"Midnight Memories is the third studio album by English-Irish boy band One Direction, released on 25 November 2013 by Columbia Records, Syco Music and Sony Music. The album was described by the band as edgier, and as having a 'slightly rockier tone' than their previous efforts. The album debuted at number one on the US Billboard 200, making them the first group in history to debut at No. 1 with its first three albums.[3] The album was preceded by the release of the singles 'Best Song Ever' and 'Story of My Life'.<h4>Tracks on the Album:</h4><ol id='albumTracks'><li>Best Song Ever</li><li>Story of My Life</li><li>Diana</li><li>Midnight Memories</li><li>You and I</li><li>Don't Forget Where You Belong</li><li>Strong</li><li>Happily</li><li>Right Now</li><li>Little Black Dress</li><li>Through the Dark</li><li>Something Great</li><li>Little White Lies</li><li>Better Than Words</li></ol><div id='source'>Source: <a href='http://en.wikipedia.org/wiki/Midnight_Memories' target='_blank'> Wikipedia </a></div>"}
			};
			
			String a = request.getParameter("productId");
			
			String b = "";
			
			int num = Integer.parseInt(a);
			
			switch(num){
				case 1: b = "images/1.jpg"; break;
				case 7: b = "images/1.jpg"; break;
				case 2: b = "images/2.jpg"; break;
				case 9: b = "images/2.jpg"; break;
				case 3: b = "images/3.jpg"; break;
				case 4: b = "images/4.jpg"; break;
				case 10: b = "images/4.jpg"; break;
				case 5: b = "images/5.jpg"; break;
				case 8: b = "images/5.jpg"; break;
				case 6: b = "images/6.jpg"; break;
				case 11: b = "images/11.jpg"; break;
				case 12: b = "images/12.jpg"; break;
				case 13: b = "images/13.jpg"; break;
				case 14: b = "images/14.jpg"; break;
				case 15: b = "images/15.jpg"; break;
			}
			
			out.println("<!DOCTYPE html>");
			out.println("<html><head>");
			out.println("<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>");
			out.println("<link rel='stylesheet' type='text/css' href='css/main.css' />");
			out.println("<title>" + details[num][0] + "</title></head>");
			out.println("<style>#detailsHeader{background-image:url('" + b + "');}</style>");
			out.println("<body class='bgBody'>");
			out.println("<div id='detailsContainer'>");
			out.println("	<div id='detailsHeader'></div>");
			out.println("	<ul>");
			out.println("		<li id='details' class='product" + a + "'>");
			out.println("			<div id='detailInfoContainer'>");
			out.println("				<div id='detailAlbum' class='productArt'></div>");
			out.println("				<div id='detailInfo'>");
			out.println("					<ul>");
			out.println("						<li id='title'>" + details[num][0] + "</li>");
			out.println("						<li id='artist'>" + details[num][1] + "</li>");
			out.println("					</ul>");
			out.println("				</div>");
			out.println("			</div>");
			out.println("			<div id='productDetails'>" + details[num][2] + "</div>");
			out.println("		</li>");
			out.println("</ul></div></body></html>");
		} 
		finally {
			out.close();
		}
	}
}