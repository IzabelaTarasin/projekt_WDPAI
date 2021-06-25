<p>Address</p>
<p>Postal Code</p>
<p id="postal-code"><?= isset($place) ? $place->getPostalCode() : '';?></p>
<p>City</p>
<p id="city"><?= isset($place) ? $place->getCity() : '';?></p>
<p>Number</p>
<p id="number"><?= isset($place) ? $place->getNumber() : '';?></p>
<p>Street</p>
<p id="street"><?= isset($place) ? $place->getStreet() : '';?></p>