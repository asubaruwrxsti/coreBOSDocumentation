---
title: 'Google Calendar Sync: Separating Events/Calendars'
metadata:
    description: ' Separating Events/Calendars'
    author: 'Joe Bordes'
content:
    items:
        - '@self.children'
    limit: 5
    order:
        by: date
        dir: desc
    pagination: true
    url_taxonomy_filters: true
taxonomy:
    category:
        - adminmanual
        - security
    tag:
        - backup
---
---
<div class="notices blue">
<h2>The problem I am facing is that personal events that I have on my
Google calendar are showing up on my task list in coreBOS. How can I get
this to stop? I do not keep 2 calendars and I prefer to work with only
one. I see in calendar settings that "Google is connected" for my user
name. Is this why my task list is picking up everything from my Google
calendar?</h2> </div>


The solution to this is to create different calendars in google and
different activity types in coreBOS to separate work events from
personal events.

-   Go to your Google Calendar
-   On the left list of "My Calendars" click on the dropdown icon and
    select the "Create Calendar" option
-   Give it a name, select the other options you need and save
-   Pick a color for the calendar by clicking on the calendar name
-   Create your personal events on this new calendar
-   As long as you do not sync any of the coreBOS Calendar types all the
    events on the personal calendar will stay only on Google Calendar

![](googlecalendarcreatecalendareventpersonal.png?width=100%)

[plugin:youtube](https://youtu.be/JzIl-Q3Ja-I)
