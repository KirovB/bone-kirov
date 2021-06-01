# Bone Kirov Test Pugin
How to ?

# Step 1
Install the plugin.

# Step 2
Activate the plugin.

# Step 3 
Please make sure you have installed ACF (Advanced Custom Field) Plugin.

# Step 4
Trigger the API Function from:
Import_countries() function or visit youriste.com/wp-admin/admin-ajax.php?action=import_countries

# Step 5 Pick a template page. 
1. Full List Countries = Page with list of all countries.
2. User Fav Template = User favourites.
3. Log In  Template = Login Page.


# Feautures missing:
  created at
  description
(I didnt had enough time to finish this, but this will work basicly same as the Add to Favourites, I would create text area and on submit button will go to new post type 
example 'Users Descriptions' )

# Things I was planing to improve
1. Import countries on plugin activation or Add Plugin page with button import countries.
2. Cron Job and if user reactivate the plugin to if check there is any changes in Populaton and Region and update them.
3. Ajax Remove from favourite list in User page. 
4. It is not OOP.
5. No comments and possibly some function names are not named properly.
