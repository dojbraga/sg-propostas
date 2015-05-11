<?
/*
  Class GoogleCalendarWrapper usage example
  Author: Skakunov Alex (i1t2b3@gmail.com)
  Date: 26.11.06
  Description: shows how to add a new event in Google Calendar. You must define login and password.
    Class adds events into your main calendar by default.
    If you want to add events in other calendar, write its XML URL into "feed_url" property like this:
  
      $gc = new GoogleCalendarWrapper("email@gmail.com", "password");
  
      $gc->feed_url =
            "http://www.google.com/calendar/feeds/pcafiuntiuro1rs%40group.calendar.google.com/private-586fa023b6a7151779f99b/basic";
    You can provide "basic" URL, it will be automatically converted to "full" one (prepare_feed_url() method).
    How to get the XML URL: http://code.google.com/apis/gdata/calendar.html#get_feed
*/


include "GoogleCalendarWrapper.php";


$gc = new GoogleCalendarWrapper("email@que_ira_cadastrar_agenda.com", "senha");

//http://www.google.com/calendar/feeds/untiuro1rs%40group.calendar.google.com/private-6a7151779f99b/basic";
//specify this, if you want to work with not-default calendar (check this: http://code.google.com/apis/gdata/calendar.html#get_feed)

if($gc->add_event($s))
  echo "event '".$s["title"]."' has been added!";
else
  echo "error";

?>