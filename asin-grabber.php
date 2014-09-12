<?php
/*
Plugin Name: Amazon Asin Grabber
Plugin URI: http://seegatesite.com
Description: With Amazon Asin Grabber plugin, you can grab unlimited Amazon Asin Code. Make sure your hosting powerful, before you grab thousands of ASIN :) 
Version: 1.0
Author: Sigit prasetya nugroho
Author URI: http://seegatesite.com/
*/
/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
add_action('admin_menu', 'sgt_ag_lokasi_menu');
include "asingrab.php";
function sgt_ag_lokasi_menu(){
     add_options_page('Amazon ASIN Grabber', 'Amazon ASIN Grabber', 'manage_options', 'sgt-ag-asin-grab', 'sgt_ag_asin_grabber_func');
}

function sgt_ag_asin_back(){
	return admin_url("options-general.php?page=sgt-ag-asin-grab");
}

function sgt_ag_asin_grabber_func()
{
	if (isset($_POST['submit']))
	{
		if(!empty($_POST['asin_txt']) && !empty($_POST['page']) )
		{
			if (filter_var($_POST['asin_txt'], FILTER_VALIDATE_URL) === FALSE) {
				?>
				<button onclick="history.go(-1);">Back </button><br />
				<?php
				die('Not a valid URL Address');
			}
			$hasil=sgt_ag_graburl(urlencode($_POST['asin_txt']),$_POST['page']);
			echo $hasil;
		}else
		{
			?>
				<button onclick="history.go(-1);">Back </button><br />
				<?php
				die('Please fill URL Address or Page count');
		}
	}
		else
	{ ?>
    <div class="wrap">
	<form method="post" action="<?php echo sgt_ag_asin_back();?>">
	<h2>Amazon Asin Grabber</h2>
    <table>
   		<tr>
        	<td>Url</td>
            <td> : <input type="text" id="asin_txt" name="asin_txt" placeholder="Example : http://www.amazon.com/s?keywords=iphone" size="100" /></td>
        </tr>
        <tr>
        	<td>Page</td>
            <td> : <input type="text" size="3" id="page" name="page" value="10" /></td>
        </tr>
  		<tr>
        	<td ><input type="submit" name="submit" id="submit"></td>
        </tr>
        <tr>
        	<td colspan="2" align="center"><h3>Did you like this plugin? if you can, donate to developers :) </h3></td>
        </tr>
       <tr>
        	<td colspan="2" align="center">
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="YHYXZU32A6QQC">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

            </td>
        </tr>
    </table>
  </form></div>
<?php 	}

} ?>