<div class="place__item__description_address_container">
    <ul>
        <li id="postal-code"><?= isset($place) ? $place->getPostalCode() : '';?></li>
        <li id="city"><?= isset($place) ? $place->getCity() : '';?></li>
        <li id="number"><?= isset($place) ? $place->getNumber() : '';?></li>
        <li id="street"><?= isset($place) ? $place->getStreet() : '';?></li>
    </ul>
</div>