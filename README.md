# Bolt 5 drag and drop extension

Author: Philipp Jeschek

This extension enables drag and drop sorting for records in the backend.

Installation:

```bash
composer require jeschek/dragsort
```

To enable drag and drop sorting add the following field to your content type:

```yaml
sort:
    type: number
    mode: integer
    default: 10
```