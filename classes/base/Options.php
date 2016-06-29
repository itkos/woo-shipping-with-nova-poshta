<?php
namespace plugins\NovaPoshta\classes\base;

/**
 * Class Options
 * @package plugins\NovaPoshta\classes\base
 *
 * @property int locationsLastUpdateDate
 * @property string areasHash
 * @property string citiesHash
 * @property string warehousesHash
 * @property array shippingMethodSettings
 * @property string senderArea
 * @property string senderCity
 * @property string senderWarehouse
 * @property string apiKey
 *
 */
class Options extends Base
{
    const AREA_NAME = 'area_name';
    const AREA = 'area';
    const CITY_NAME = 'city_name';
    const CITY = 'city';
    const WAREHOUSE_NAME = 'warehouse_name';
    const WAREHOUSE = 'warehouse';
    const API_KEY = 'api_key';

    /**
     * @return int
     */
    public function getLocationsLastUpdateDate()
    {
        $this->locationsLastUpdateDate = $this->getOption('locations_last_update_date') ?: 0;
        return $this->locationsLastUpdateDate;
    }

    /**
     * @param int $value
     */
    public function setLocationsLastUpdateDate($value)
    {
        $this->setOption('locations_last_update_date', $value);
        $this->locationsLastUpdateDate = $value;
    }

    /**
     * @return string
     */
    public function getAreasHash()
    {
        $this->areasHash = $this->getOption('areas_hash') ?: '';
        return $this->areasHash;
    }

    /**
     * @param string $value
     */
    public function setAreasHash($value)
    {
        $this->setOption('areas_hash', $value);
        $this->areasHash = $value;
    }

    /**
     * @return string
     */
    public function getCitiesHash()
    {
        $this->citiesHash = $this->getOption('cities_hash') ?: '';
        return $this->citiesHash;
    }

    /**
     * @param string $citiesHash
     */
    public function setCitiesHash($citiesHash)
    {
        $this->setOption('cities_hash', $citiesHash);
        $this->citiesHash = $citiesHash;
    }

    /**
     * @return string
     */
    public function getWarehousesHash()
    {
        $this->warehousesHash = $this->getOption('warehouses_hash') ?: '';
        return $this->warehousesHash;
    }

    /**
     * @param string $warehousesHash
     */
    public function setWarehousesHash($warehousesHash)
    {
        $this->setOption('warehouses_hash', $warehousesHash);
        $this->warehousesHash = $warehousesHash;
    }

    /**
     * @return array
     */
    protected function getShippingMethodSettings()
    {
        $this->shippingMethodSettings = get_site_option('woocommerce_nova_poshta_shipping_method_settings');
        return $this->shippingMethodSettings;
    }

    /**
     * @return string
     */
    protected function getSenderArea()
    {
        $this->senderArea = $this->shippingMethodSettings[self::AREA];
        return $this->senderArea;
    }

    /**
     * @return string
     */
    protected function getSenderCity()
    {
        $this->senderCity = $this->shippingMethodSettings[self::CITY];
        return $this->senderCity;
    }

    /**
     * @return string
     */
    protected function getSenderWarehouse()
    {
        $this->senderWarehouse = $this->shippingMethodSettings[self::WAREHOUSE];
        return $this->senderWarehouse;
    }

    /**
     * @return string
     */
    protected function getApiKey()
    {
        $this->apiKey = $this->shippingMethodSettings[self::API_KEY];
        return $this->apiKey;
    }

    /**
     * Delete all plugin specific options from wp_options table
     */
    public function clearOptions()
    {
        $query = "DELETE FROM wp_options WHERE option_name LIKE CONCAT ('_nova_poshta_', '%')";
        NP()->db->query($query);
    }

    /**
     * @param $optionName
     * @return mixed
     */
    private function getOption($optionName)
    {
        $key = "_nova_poshta_" . $optionName;
        return get_option($key);
    }

    /**
     * @param string $optionName
     * @param mixed $optionValue
     */
    private function setOption($optionName, $optionValue)
    {
        $key = "_nova_poshta_" . $optionName;
        update_option($key, $optionValue);
    }

    /**
     * @var Options
     */
    private static $_instance;

    /**
     * @return Options
     */
    public static function instance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Options constructor.
     *
     * @access private
     */
    private function __construct()
    {
    }

    /**
     * @access private
     */
    private function __clone()
    {
    }
}