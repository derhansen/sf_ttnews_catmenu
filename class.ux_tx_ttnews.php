<?php

class ux_tx_ttnews extends tx_ttnews {

	/**
	 * This function calls itself recursively to convert the nested category array to HTML
	 *
	 * @param	array		$array_in: the nested categories
	 * @param	array		$lConf: TS configuration
	 * @param	integer		$l: level counter
	 * @return	string		HTML for the category menu
	 */
	function getCatMenuContent($array_in, $lConf, $l = 0) {
		$titlefield = 'title';
		if (is_array($array_in)) {
			$result = '';
			foreach ($array_in as $key => $val) {
				if ($key == $titlefield || is_array($array_in[$key])) {
					if ($l) {
						$catmenuLevel_stdWrap = explode('|||', $this->local_cObj->stdWrap('|||', $lConf['catmenuLevel' . $l . '_stdWrap.']));
						$result .= $catmenuLevel_stdWrap[0];
					}
					if (is_array($array_in[$key])) {
						$result .= $this->getCatMenuContent($array_in[$key], $lConf, $l + 1);
					} elseif ($key == $titlefield) {
						if ($GLOBALS['TSFE']->sys_language_content && $array_in['uid']) {
							// get translations of category titles
							$catTitleArr = t3lib_div::trimExplode('|', $array_in['title_lang_ol']);
							$syslang = $GLOBALS['TSFE']->sys_language_content - 1;
							$val = $catTitleArr[$syslang] ? $catTitleArr[$syslang] : $val;
						}
						// if (!$title) $title = $val;
						$catSelLinkParams = ($this->conf['catSelectorTargetPid'] ? ($this->conf['itemLinkTarget'] ? $this->conf['catSelectorTargetPid'] . ' ' . $this->conf['itemLinkTarget'] : $this->conf['catSelectorTargetPid']) : $GLOBALS['TSFE']->id);
						$pTmp = $GLOBALS['TSFE']->ATagParams;
						if ($this->conf['displayCatMenu.']['insertDescrAsTitle']) {
							$GLOBALS['TSFE']->ATagParams = ($pTmp ? $pTmp . ' ' : '') . 'title="' . $array_in['description'] . '"';
						}
						if ($array_in['uid']) {
							// Add category image
							$iconConf['image.']['file'] = 'uploads/pics/'.$array_in['image'];
							$iconConf['image.']['wrap'] = $lConf['catmenuIconWrap'];
							if ($iconConf['image.']['file']) {
							    $iconConf['image.']['file.'] = $lConf['catmenuIconFile.'];
							    $result .= $GLOBALS['TSFE']->cObj->IMAGE($iconConf['image.']);
							}

							if ($this->piVars['cat'] == $array_in['uid']) {
								$result .= $this->local_cObj->stdWrap($this->pi_linkTP_keepPIvars($val, array('cat' => $array_in['uid']), $this->allowCaching, 1, $catSelLinkParams), $lConf['catmenuItem_ACT_stdWrap.']);
							} else {
								$result .= $this->local_cObj->stdWrap($this->pi_linkTP_keepPIvars($val, array('cat' => $array_in['uid']), $this->allowCaching, 1, $catSelLinkParams), $lConf['catmenuItem_NO_stdWrap.']);
							}
						} else {
							$result .= $this->pi_linkTP_keepPIvars($val, array(), $this->allowCaching, 1, $catSelLinkParams);
						}
						$GLOBALS['TSFE']->ATagParams = $pTmp;
					}
					if ($l) {
						$result .= $catmenuLevel_stdWrap[1];
					}
				}
			}
		}
		return $result;
	}

}

?>


