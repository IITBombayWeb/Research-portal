Menu svg icons 8.x - 1.x
==============================

This module provides svg sprite icons for frontend oriented menus.
1. Construct your icon set under settings.
2. Chose an icon set for a specific menu in the menu administration.
3. On each menu item you can select an icon from the selected icon set.

A simple sprite with arrows is provided on install as an example.

The svg sprite should be constructed in a specific way following:
<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
  <defs>
    <symbol viewBox="0 0 8 8" id="account-login">
      <path d="M3 0v1h4v5h-4v1h5v-7h-5zm1 2v1h-4v1h4v1l2-1.5-2-1.5z"></path>
    </symbol>
  </defs>
</svg>
