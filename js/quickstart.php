    <!--Add buttons to initiate auth sequence and sign out-->
    <button id="authorize-button" style="display: none;">Authorize</button>
    <button id="signout-button" style="display: none;">Sign Out</button>

    <div id="content"></div>

    <script type="text/javascript">
      // Client ID and API key from the Developer Console
      var CLIENT_ID = '566628269148-cffec53l8l0goo09vvoq6tlll102r69j.apps.googleusercontent.com';

      // Array of API discovery doc URLs for APIs used by the quickstart
      var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

      // Authorization scopes required by the API; multiple scopes can be
      // included, separated by spaces.
      var SCOPES = "https://www.googleapis.com/auth/calendar.readonly";

      var authorizeButton = document.getElementById('authorize-button');
      var signoutButton = document.getElementById('signout-button');

      /**
       *  On load, called to load the auth2 library and API client library.
       */
      function handleClientLoad() {
        gapi.load('client:auth2', initClient);
      }

      /**
       *  Initializes the API client library and sets up sign-in state
       *  listeners.
       */
      function initClient() {
        gapi.client.init({
          discoveryDocs: DISCOVERY_DOCS,
          clientId: CLIENT_ID,
          scope: SCOPES
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
          authorizeButton.onclick = handleAuthClick;
          signoutButton.onclick = handleSignoutClick;
        });
      }

      /**
       *  Called when the signed in status changes, to update the UI
       *  appropriately. After a sign-in, the API is called.
       */
      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
          authorizeButton.style.display = 'none';
          //signoutButton.style.display = 'block';
          listUpcomingEvents();
        } else {
          authorizeButton.style.display = 'block';
          signoutButton.style.display = 'none';
        }
      }

      /**
       *  Sign in the user upon button click.
       */
      function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
      }

      /**
       *  Sign out the user upon button click.
       */
      function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }

      /**
       * Append a pre element to the body containing the given message
       * as its text node. Used to display the results of the API call.
       *
       * @param {string} message Text to be placed in pre element.
       */
			 function appendPre(message) {
         var pre = document.getElementById('content');
         var textContent = document.createTextNode(message + '\n');
         pre.appendChild(textContent);
       }
			 function appendHtml(message) {
         var pre = document.getElementById('content');
         pre.innerHTML=message;
       }

      /**
       * Print the summary and start datetime/date of the next ten events in
       * the authorized user's calendar. If no events are found an
       * appropriate message is printed.
       */
      function listUpcomingEvents() {
        gapi.client.calendar.events.list({
          'calendarId': 'gtarnu64qd4r4tvvi8lh5bssc8@group.calendar.google.com',
          'timeMin': (new Date()).toISOString(),
          'showDeleted': false,
          'singleEvents': true,
          'maxResults': 4,
          'orderBy': 'startTime'
        }).then(function(response) {
          var events = response.result.items;
					var text2insert='';

          if (events.length > 0) {
            for (i = 0; i < events.length; i++) {
              var event = events[i];
              var when = event.start.dateTime;
							console.log(event);
              if (!when) {
                when = event.start.date;
              }
							var Dunformatted=new Date(when);
							when = convertDate(Dunformatted);
              text2insert +='<li>' + when + ' - ' + event.summary + '</li>';
            }
          } else {
            text2insert +='No upcoming events found.';
          }
					appendHtml(text2insert);
        });
      }

			function convertDate(date) {
			  var monthNames = [
			    "JAN", "FEB", "MAR",
			    "APR", "MAY", "JUN", "JUL",
			    "AUG", "SEP", "OCT",
			    "NOV", "DEC"
			  ];
				var min = date.getMinutes();
				var hour = date.getHours();
			  var day = date.getDate();
			  var monthIndex = date.getMonth();
			  var year = date.getFullYear();

			  return day + ' ' + monthNames[monthIndex];
			}
    </script>

    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
