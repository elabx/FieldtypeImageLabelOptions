# InputfieldImageLabelOptions

ProcessWire Inputfield modules that render radio buttons and checkboxes as selectable images or styled labels. Works as a drop-in for any `FieldtypeOptions` field — no custom Fieldtype required.

Implements the technique from [this Stack Overflow answer](https://stackoverflow.com/a/17541916/3612981): hides the native input and styles the label content as the clickable selector.

## Modules Included

- **InputfieldRadiosImageLabel** — single-select (radios)
- **InputfieldCheckboxesImageLabel** — multi-select (checkboxes)

## Installation

Via Composer:

```bash
composer require elabx/inputfield-image-label-options
```

Or manually copy the files into `site/modules/` and refresh modules in the admin.

## Usage

1. Create or edit a field of type **Options** (`FieldtypeOptions`).
2. In the **Details** tab, define your options as usual.
3. In the **Input** tab, change the **Inputfield Type** to **Inputfield Radios Image Label** (or **Inputfield Checkboxes Image Label**).
4. Configure the image mapping and display options that appear below:

### Option Images

Enter one mapping per line in the format `option_id=image_url`:

```
1=/site/templates/img/small.png
2=/site/templates/img/medium.png
3=/site/templates/img/large.png
```

Options without a mapping display as text labels.

### Display Options

- **Desktop Image Width** — Width in pixels on desktop (default: 150px)
- **Mobile Image Width** — Width in pixels on mobile (default: 100px)
- **Image Aspect Ratio** — Constrain images to a ratio like `16:9`, `1:1`, `4:3` (leave empty for none)
- **Show Label Below Image** — Display the option's text label under the image

## Customization

Each module ships with a CSS file (`InputfieldRadiosImageLabel.css` / `InputfieldCheckboxesImageLabel.css`) that handles input hiding and selection borders. Override these styles in your admin theme CSS as needed.
