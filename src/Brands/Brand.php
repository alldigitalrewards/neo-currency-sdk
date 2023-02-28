<?php

namespace AllDigitalRewards\NeoCurrency\Brands;

use AllDigitalRewards\NeoCurrency\AbstractEntity;

class Brand extends AbstractEntity
{
    protected $id;
    protected $name;
    protected $real_name;
    protected $value;
    protected $min;
    protected $max;
    protected $is_reward_choice;
    protected $reward_choice_type;
    protected $logo;
    protected $logo_new;
    protected $card_img;
    protected $card_img_new;
    protected $rewrite_img;
    protected $logo_custom;
    protected $header;
    protected $header_image;
    protected $header_background_color;
    protected $under_header;
    protected $description;
    protected $description_update;
    protected $terms;
    protected $terms_update;
    protected $reward_gateways_id;
    protected $currency_id;
    protected $created_at;
    protected $updated_at;
    protected $active;
    protected $accessibility;
    protected $group_id;
    protected $card;
    protected $instructions;
    protected $instructions_update;
    protected $redemption_url;
    protected $redemption_url_label;
    protected $type;
    protected $ux_type;
    protected $no_expiration;
    protected $template_enter_text;
    protected $template_subtitle_after_actived;
    protected $template_enter_activate_text;
    protected $showtimeFlag;
    protected $is_physical;
    protected $is_raw_codes;
    protected $is_physical_and_digital;
    protected $is_bulk;
    protected $is_copy_code_button;
    protected $delivery_format;
    protected $expiry_date_policy;
    protected $expiry_in_months;
    protected $expiry_mode;
    protected $lang;
    protected $check_back;
    protected $search_keywords;
    protected $country_code;
    protected $currency_name;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getRealName()
    {
        return $this->real_name;
    }

    public function setRealName($real_name): void
    {
        $this->real_name = $real_name;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

    public function getMin()
    {
        return $this->min;
    }

    public function setMin($min): void
    {
        $this->min = $min;
    }

    public function getMax()
    {
        return $this->max;
    }

    public function setMax($max): void
    {
        $this->max = $max;
    }

    public function getIsRewardChoice()
    {
        return $this->is_reward_choice;
    }

    public function setIsRewardChoice($is_reward_choice): void
    {
        $this->is_reward_choice = $is_reward_choice;
    }

    public function getRewardChoiceType()
    {
        return $this->reward_choice_type;
    }

    public function setRewardChoiceType($reward_choice_type): void
    {
        $this->reward_choice_type = $reward_choice_type;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo): void
    {
        $this->logo = $logo;
    }

    public function getLogoNew()
    {
        return $this->logo_new;
    }

    public function setLogoNew($logo_new): void
    {
        $this->logo_new = $logo_new;
    }

    public function getCardImg()
    {
        return $this->card_img;
    }

    public function setCardImg($card_img): void
    {
        $this->card_img = $card_img;
    }

    public function getCardImgNew()
    {
        return $this->card_img_new;
    }

    public function setCardImgNew($card_img_new): void
    {
        $this->card_img_new = $card_img_new;
    }

    public function getRewriteImg()
    {
        return $this->rewrite_img;
    }

    public function setRewriteImg($rewrite_img): void
    {
        $this->rewrite_img = $rewrite_img;
    }

    public function getLogoCustom()
    {
        return $this->logo_custom;
    }

    public function setLogoCustom($logo_custom): void
    {
        $this->logo_custom = $logo_custom;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setHeader($header): void
    {
        $this->header = $header;
    }

    public function getHeaderImage()
    {
        return $this->header_image;
    }

    public function setHeaderImage($header_image): void
    {
        $this->header_image = $header_image;
    }

    public function getHeaderBackgroundColor()
    {
        return $this->header_background_color;
    }

    public function setHeaderBackgroundColor($header_background_color): void
    {
        $this->header_background_color = $header_background_color;
    }

    public function getUnderHeader()
    {
        return $this->under_header;
    }

    public function setUnderHeader($under_header): void
    {
        $this->under_header = $under_header;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getDescriptionUpdate()
    {
        return $this->description_update;
    }

    public function setDescriptionUpdate($description_update): void
    {
        $this->description_update = $description_update;
    }

    public function getTerms()
    {
        return $this->terms;
    }

    public function setTerms($terms): void
    {
        $this->terms = $terms;
    }

    public function getTermsUpdate()
    {
        return $this->terms_update;
    }

    public function setTermsUpdate($terms_update): void
    {
        $this->terms_update = $terms_update;
    }

    public function getRewardGatewaysId()
    {
        return $this->reward_gateways_id;
    }

    public function setRewardGatewaysId($reward_gateways_id): void
    {
        $this->reward_gateways_id = $reward_gateways_id;
    }

    public function getCurrencyId()
    {
        return $this->currency_id;
    }

    public function setCurrencyId($currency_id): void
    {
        $this->currency_id = $currency_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active): void
    {
        $this->active = $active;
    }

    public function getAccessibility()
    {
        return $this->accessibility;
    }

    public function setAccessibility($accessibility): void
    {
        $this->accessibility = $accessibility;
    }

    public function getGroupId()
    {
        return $this->group_id;
    }

    public function setGroupId($group_id): void
    {
        $this->group_id = $group_id;
    }

    public function getCard()
    {
        return $this->card;
    }

    public function setCard($card): void
    {
        $this->card = $card;
    }

    public function getInstructions()
    {
        return $this->instructions;
    }

    public function setInstructions($instructions): void
    {
        $this->instructions = $instructions;
    }

    public function getInstructionsUpdate()
    {
        return $this->instructions_update;
    }

    public function setInstructionsUpdate($instructions_update): void
    {
        $this->instructions_update = $instructions_update;
    }

    public function getRedemptionUrl()
    {
        return $this->redemption_url;
    }

    public function setRedemptionUrl($redemption_url): void
    {
        $this->redemption_url = $redemption_url;
    }

    public function getRedemptionUrlLabel()
    {
        return $this->redemption_url_label;
    }

    public function setRedemptionUrlLabel($redemption_url_label): void
    {
        $this->redemption_url_label = $redemption_url_label;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): void
    {
        $this->type = $type;
    }

    public function getUxType()
    {
        return $this->ux_type;
    }

    public function setUxType($ux_type): void
    {
        $this->ux_type = $ux_type;
    }

    public function getNoExpiration()
    {
        return $this->no_expiration;
    }

    public function setNoExpiration($no_expiration): void
    {
        $this->no_expiration = $no_expiration;
    }

    public function getTemplateEnterText()
    {
        return $this->template_enter_text;
    }

    public function setTemplateEnterText($template_enter_text): void
    {
        $this->template_enter_text = $template_enter_text;
    }

    public function getTemplateSubtitleAfterActived()
    {
        return $this->template_subtitle_after_actived;
    }

    public function setTemplateSubtitleAfterActived($template_subtitle_after_actived): void
    {
        $this->template_subtitle_after_actived = $template_subtitle_after_actived;
    }

    public function getTemplateEnterActivateText()
    {
        return $this->template_enter_activate_text;
    }

    public function setTemplateEnterActivateText($template_enter_activate_text): void
    {
        $this->template_enter_activate_text = $template_enter_activate_text;
    }

    public function getShowtimeFlag()
    {
        return $this->showtimeFlag;
    }

    public function setShowtimeFlag($showtimeFlag): void
    {
        $this->showtimeFlag = $showtimeFlag;
    }

    public function getIsPhysical()
    {
        return $this->is_physical;
    }

    public function setIsPhysical($is_physical): void
    {
        $this->is_physical = $is_physical;
    }

    public function getIsRawCodes()
    {
        return $this->is_raw_codes;
    }

    public function setIsRawCodes($is_raw_codes): void
    {
        $this->is_raw_codes = $is_raw_codes;
    }

    public function getIsPhysicalAndDigital()
    {
        return $this->is_physical_and_digital;
    }

    public function setIsPhysicalAndDigital($is_physical_and_digital): void
    {
        $this->is_physical_and_digital = $is_physical_and_digital;
    }

    public function getIsBulk()
    {
        return $this->is_bulk;
    }

    public function setIsBulk($is_bulk): void
    {
        $this->is_bulk = $is_bulk;
    }

    public function getIsCopyCodeButton()
    {
        return $this->is_copy_code_button;
    }

    public function setIsCopyCodeButton($is_copy_code_button): void
    {
        $this->is_copy_code_button = $is_copy_code_button;
    }

    public function getDeliveryFormat()
    {
        return $this->delivery_format;
    }

    public function setDeliveryFormat($delivery_format): void
    {
        $this->delivery_format = $delivery_format;
    }

    public function getExpiryDatePolicy()
    {
        return $this->expiry_date_policy;
    }

    public function setExpiryDatePolicy($expiry_date_policy): void
    {
        $this->expiry_date_policy = $expiry_date_policy;
    }

    public function getExpiryInMonths()
    {
        return $this->expiry_in_months;
    }

    public function setExpiryInMonths($expiry_in_months): void
    {
        $this->expiry_in_months = $expiry_in_months;
    }

    public function getExpiryMode()
    {
        return $this->expiry_mode;
    }

    public function setExpiryMode($expiry_mode): void
    {
        $this->expiry_mode = $expiry_mode;
    }

    public function getLang()
    {
        return $this->lang;
    }

    public function setLang($lang): void
    {
        $this->lang = $lang;
    }

    public function getCheckBack()
    {
        return $this->check_back;
    }

    public function setCheckBack($check_back): void
    {
        $this->check_back = $check_back;
    }

    public function getSearchKeywords()
    {
        return $this->search_keywords;
    }

    public function setSearchKeywords($search_keywords): void
    {
        $this->search_keywords = $search_keywords;
    }

    public function getCountryCode()
    {
        return $this->country_code;
    }

    public function setCountryCode($country_code): void
    {
        $this->country_code = $country_code;
    }

    public function getCurrencyName()
    {
        return $this->currency_name;
    }

    public function setCurrencyName($currency_name): void
    {
        $this->currency_name = $currency_name;
    }
}