# Bolt 5 drag and drop extension

Author: Philipp Jeschek

This extension enables drag and drop sorting for records in the backend of Bolt 5.

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

There are some issues when trying to sort the records in the backend using

```yaml
order: sort
```

To bypass that the addon changes the creation date to be able to sort by that property.
If you use the creation date please create a full database backup before using this addon.

```yaml
order: createdAt
```