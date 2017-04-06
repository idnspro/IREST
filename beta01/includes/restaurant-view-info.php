<?php
if ( is_array( $restConf ) && ! empty( $restConf ) ) {
	echo '<div id="rest-info">';
	//Delivery Area
	if ( ! empty( $restConf['delivery_area_note'] ) ) {
		echo '<h3>' . $rest_name .' - Delivery Area</h3>';
		echo '<div id="rest-info-delivery-area">' . $restConf['delivery_area_note'] . '</div>';
	}
	//Delivery Hours
	if ( ! empty( $restConf['delivery_hrs_mon'] ) ) {
		echo '<h3>' . $rest_name .' - Delivery Hours</h3>';
		echo '<div id="rest-info-delivery-hours">';
		echo '<table width="100%" border="0">';
		echo '<tr><td><b>Mon</b></td><td>: '.$restConf['delivery_hrs_mon'].'</td></tr>';
		echo '<tr><td><b>Tue</b></td><td>: '.$restConf['delivery_hrs_tue'].'</td></tr>';
		echo '<tr><td><b>Wed</b></td><td>: '.$restConf['delivery_hrs_wed'].'</td></tr>';
		echo '<tr><td><b>Thu</b></td><td>: '.$restConf['delivery_hrs_thu'].'</td></tr>';
		echo '<tr><td><b>Fri</b></td><td>: '.$restConf['delivery_hrs_fri'].'</td></tr>';
		echo '<tr><td><b>Sat</b></td><td>: '.$restConf['delivery_hrs_sat'].'</td></tr>';
		echo '<tr><td><b>Sun</b></td><td>: '.$restConf['delivery_hrs_sun'].'</td></tr>';
		echo '</table>';
		echo '</div>';
	}
	
	//Ordering Info
	if ( ! empty( $restConf['min_order'] ) ) {
		echo '<h3>' . $rest_name .' - Ordering Info</h3>';
		echo '<div id="rest-info-ordering">';
		echo '<table width="100%" border="0">';
		echo '<tr><td><b>Min Order</b>:</td><td>'.$currency_symbol.$restConf['min_order'].'</td></tr>';
		echo '<tr><td><b>Delivery Fee</b>:</td><td>'.$currency_symbol.$restConf['delivery_charge'].'</td></tr>';
		echo '<tr><td><b>Contact</b>:</td><td>'.$restConf['phone'].'</td></tr>';
		echo '<tr><td><b>Serving</b>:</td><td>'.$restConf['serving_note'].'</td></tr>';
		echo '</table>';
		echo '</div>';
	}
	echo '</div>';
}
