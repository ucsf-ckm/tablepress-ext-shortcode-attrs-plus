# TablePress Extension: Shortcode Attributes Plus

Provides additional attributes to the `[table /]` shortcode.

## Dependencies

This plugin is an extension to [TablePress](https://wordpress.org/plugins/tablepress/).

TablePress needs to be installed and enabled. 

## Installation

Since this plugin is not available for automatic installation, please follow these [Manual Plugin Installation](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation) steps.

## Usage

### Invisible columns

By default, all columns in a data table are visible.

You may configure a table to hide individual columns by setting the `invisible-columns` attribute on the `[table /]` shortcode to a column id or to a comma-separated list of column ids.
Please note that column ids are zero-indexed, so the first column has an id of `0`, the second has an id of `1` etc.

### Hidden search box

If searching is enabled on the given data table, the table will render with a search input box by default.

You may suppress this behaviour and configure the table to be rendered without a search input box by setting the `hide-search-box` attribute on the `[table \]` 
shortcode to a truth-y value (`true`, `TRUE` or `1`), even if searching is enabled.
 
### Examples

`[table id=1 hide-search-box=true /]` - This hides the table's search box.

`[table id=1 invisible-columns=1,2 /]` - This configures the second and third column of the table as invisible.

`[table id=1 hide-search-box=true invisible-columns=1,2 /]` - All of the above

## Copyright and License

Copyright (c) 2017 The Regents of the University of California

This is Open Source Software, published under the MIT license.
