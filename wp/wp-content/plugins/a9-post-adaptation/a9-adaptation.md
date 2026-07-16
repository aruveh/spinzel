Milestone 1 - Setup
    1.1 Plugin Skeleton
    1.2 composer.json
    1.3 Autoload
    1.4 Constants
    1.5 Bootstrap

Milestone 2 - src/Core/
    2.1 Plugin.php
    2.2 Loader.php
    2.3 Activator.php
    2.4 Deactivator.php

Milestone 3 - src/Admin/
    3.1 Menu.php
    3.2 MetaBox.php
    3.3 SaveMeta.php

Milestone 4 - src/Meta/
    4.1 Price.php
    4.2 Country.php
    4.3 AgeGroup.php
    4.4 Registry.php

Milestone 5 - src/Shortcodes/
    5.1 Meta.php
    5.2 Price.php
    5.3 Country.php
    5.4 AgeGroup.php

Milestone 6 - src/Blocks/
    6.1 DynamicBlock.php
    6.2 DynamicPrice.php
    6.3 DynamicCountry.php
    6.4 DynamicAgeGroup.php
    6.5 QueryLoop.php

Milestone 7 - src/Rest/
    7.1 Fields.php

Milestone 8 - src/Helpers/
    8.1 Formatter.php
    8.2 Sanitizer.php

Milestone 9 - src/Data/
    9.1 Countries.php

Milestone 9.1

* ✅ Create src/Data/Countries.php
* ✅ Load and cache country-list.json
* ✅ Build lookup methods
* ✅ Build dropdown options (US => United States)

Milestone 9.2

* Update Meta/Country.php to store cca2 codes instead of names.

Milestone 9.3

* Update the REST API to return the full country object (code, short, name, svg, emoji, etc.).

Milestone 9.4

* Update the [a9_meta] shortcode and formatter so templates can easily output either the country name or the full object, depending on context.

a9-post-adaptation/
│
├── assets/
│
├── languages/
│
├── src/
│   ├── Admin/
│   ├── Blocks/
│   ├── Core/
│   ├── Data/
│   ├── Helpers/
│   ├── Meta/
│   ├── Rest/
│   └── Shortcodes/
│
├── a9-post-adaptation.php
├── composer.json
├── uninstall.php
└── readme.txt