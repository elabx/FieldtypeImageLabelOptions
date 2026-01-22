<?php
namespace ProcessWire;

/**
 * InputfieldCheckboxesImageLabel
 *
 * Renders checkboxes using images or styled labels, following the technique:
 * https://stackoverflow.com/a/17541916/3612981
 *
 */

class InputfieldCheckboxesImageLabel extends InputfieldCheckboxes
{

	public static function getModuleInfo()
	{
		return array(
			'title' => 'Inputfield Checkboxes Image Label',
			'version' => 100,
			'summary' => 'Checkboxes that use images/labels instead of standard checkboxes, suitable for FieldtypeOptions.',
			'requires' => 'ProcessWire>=3.0.0',
		);
	}

	public function getConfigInputfields()
	{
		$inputfields = parent::getConfigInputfields();

		// Note: optionImages is configured at the Field level (FieldtypeImageLabelOptions),
		// not at the Inputfield level, to avoid conflicts when inputfieldClass is explicitly set.

		return $inputfields;
	}

	public function render()
	{
		// Get configuration values
		$desktopWidth = isset($this->optionImageDesktopWidth) ? (int)$this->optionImageDesktopWidth : 150;
		$mobileWidth = isset($this->optionImageMobileWidth) ? (int)$this->optionImageMobileWidth : 100;
		$aspectRatio = isset($this->optionImageAspectRatio) && $this->optionImageAspectRatio ? trim($this->optionImageAspectRatio) : '';
		$showLabel = isset($this->optionImageShowLabel) && $this->optionImageShowLabel;

		// Build CSS custom properties for responsive widths (namespaced with --inputfield-image-label-options-)
		$cssVars = "--inputfield-image-label-options-desktop-width: {$desktopWidth}px; --inputfield-image-label-options-mobile-width: {$mobileWidth}px;";
		if ($aspectRatio) {
			// Parse aspect ratio (e.g., "16:9" -> 16/9 = 1.777...)
			if (preg_match('/^(\d+(?:\.\d+)?):(\d+(?:\.\d+)?)$/', $aspectRatio, $matches)) {
				$ratio = (float)$matches[1] / (float)$matches[2];
				$cssVars .= " --inputfield-image-label-options-aspect-ratio: {$ratio};";
			}
		}

		$out = "<div class='InputfieldCheckboxesImageLabelWrapper' style='$cssVars'>";

		// Parse the optionImages configuration
		$imageMap = array();
		if ($this->optionImages) {
			$lines = explode("\n", $this->optionImages);
			foreach ($lines as $line) {
				if (strpos($line, '=') === false)
					continue;
				list($k, $v) = explode('=', $line, 2);
				$imageMap[trim($k)] = trim($v);
			}
		}

		$selectedValues = $this->value;
		if(!is_array($selectedValues)) $selectedValues = array();

		foreach ($this->getOptions() as $key => $value) {
			$checked = in_array($key, $selectedValues) ? " checked='checked'" : "";
			$id = $this->id . "_" . $this->wire('sanitizer')->name($key);
			// InputfieldCheckboxes usually handles arrays, so we likely need name[]
			// But check if InputfieldCheckboxes logic requires strict name matching
			$name = $this->name . "[]"; 

			$textLabel = $this->wire('sanitizer')->entities($value);
			$hasImage = isset($imageMap[$key]);

			// If an image is defined for this option key, use it
			if ($hasImage) {
				$imgUrl = $this->wire('sanitizer')->url($imageMap[$key]);
				
				// Determine wrapper class - apply aspect ratio to image wrapper
				$wrapperClass = 'image-wrapper';
				if ($aspectRatio) {
					$wrapperClass .= ' has-aspect-ratio';
				}
				
				$label = "<span class='$wrapperClass'><img src='$imgUrl' alt='$textLabel' class='image-label-img' /></span>";
				
				// Add label text below image if configured
				if ($showLabel) {
					$label .= "<span class='image-label-text'>$textLabel</span>";
				}
			} else {
				// Fallback to text label (entity-encoded for safety)
				$label = $textLabel;
			}

			$out .= "<label for='$id' class='image-label-option'>";
			$out .= "<input type='checkbox' name='$name' id='$id' value='$key'$checked />";
			$out .= "<span class='content'>$label</span>";
			$out .= "</label>";
		}

		$out .= "</div>";
		return $out;
	}
}
