Given only with a few classes/files to refactor the codes, I would say that I like that we are using Repository pattern to separate the business logic.
However, the BookingController is not clean at all and has some business logic in it, I believe the controller class is always thin.
Aside from that I find it weird that the Model of BookingRepository is called Job.

One of the most noticeable thing is that most constants that are being used repeatedly are not defined.
Examples are 'rws', 'paid', 'unpaid', 'Man', 'Kvinna', the user_type 1 or 2, etc.
I think it is best to put them somewhere else like config constants or inside a Model class as constants or enum.


Most of the things that I refactored are the repetitive codes and a sequence or nested if-else conditions.
For me, many if-else statements are difficult to read and maintain. So to combat that issue, I used the early return pattern.
Early return pattern is when a method is immediately stopped as soon as a specific condition is met,
so it doesn't need to go through the unnecessary lines of code just to fail at the bottom. 
I also prefer to use switch case statements instead of if-elseif, it's easier to read.
I don't want to use 'else' condition as much as possible for easy readability. I also like using ternary operator when the condition is very simple and one-liner.

The getAll() method in BookingRepository, there's a lot of going on in there -- mostly building the query based on the request parameters.
While 2-4hours is not enough to refactor it to what I want, I would build a query builder pipeline for it. 
Laravel has this feature called Pipeline that is very useful to something like this -- building a query.
Piplines are definitely easier to maintain and read while still maintinaing the performance of the application.


The sendNotificationTranslator() method, I noticed the eloquent query right away, User::all().
User::all() is very slow as you will get all the columns of every existing users in the table, we would not want to retrieve all 500k users from the table.
So instead of filtering the users whether they are of user_type=2 and with status=1 in the code, I will filter it using SQL instead.
It is always better and faster do the filtering in the database, instead of checking the statuses/types in the code.
This way, you will only get the exact type of users (translators) that you will send the notifications to. No need to do the checking in the code.
So instead of retrieving like 500k users from User::all(), you will get and process A LOT less when you do the filtering in the database instead.