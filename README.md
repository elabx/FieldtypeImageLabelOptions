# InputfieldRadiosImageLabel (Alpha)

A ProcessWire Inputfield module that extends `InputfieldRadios` to render radio buttons as selectable images or styled labels.

## Description

This module implements the technique described in [this Stack Overflow answer](https://stackoverflow.com/a/17541916/3612981). It hides the standard radio button and allows you to style the label content (e.g., an image) to act as the clickable selector.

## Installation

1. Copy the `InputfieldRadiosImageLabel` directory to your ProcessWire `site/modules/` directory.
2. Login to the ProcessWire admin.
3. Go to Modules > Refresh.
4. Click "Install" next to "Inputfield Radios Image Label".

## Usage with FieldtypeOptions

### Using FieldtypeImageLabelOptions (Recommended)

1. Create or edit a field of type **Image Label Options** (`FieldtypeImageLabelOptions`).
2. In the **Details** tab, define your options (text labels only).
   - Example Options:
     ```
     small=Small
     medium=Medium
     large=Large
     ```
3. In the field configuration, set up the **Option Images** mapping:
   - Enter one mapping per line in the format: `option_id=image_url` or `option_value=image_url`
   - Example:
     ```
     small=/site/templates/img/small.png
     medium=/site/templates/img/medium.png
     large=/site/templates/img/large.png
     ```
   - If an option doesn't have an image mapping, it will display as a text label.

### Using Regular FieldtypeOptions

1. Create or edit a field of type **Options** (`FieldtypeOptions`).
2. In the **Details** tab, define your options.
3. In the **Input** tab, change the **Inputfield Type** to **Inputfield Radios Image Label**.
4. Note: To use images, you'll need to set the `optionImages` property programmatically or use the `FieldtypeImageLabelOptions` fieldtype which provides a UI for this.

## Customization

The module includes a default CSS file `InputfieldRadiosImageLabel.css` which handles the hiding of radio buttons and the selection border. You can override these styles in your own admin theme CSS or by modifying the module's CSS.
