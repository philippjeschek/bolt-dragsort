# Bolt 6 Drag & Drop Extension

Author: Philipp Jeschek

This extension enables drag and drop sorting for records in the backend of Bolt 6.

## Installation

```bash
composer require jeschek/dragsort
```

## Configuration

To enable drag and drop sorting, you need to add a `sort` field to your content type definition (e.g., in `contenttypes.yml`):

```yaml
articles:
    name: Articles
    singular_name: Article
    # ... your other configuration ...
    fields:
        # ... your other fields ...
        sort:
            type: number
            mode: integer
            group: Meta
            default: 10
```

Finally, ensure your content type is configured to order records by this newly created `sort` field:

```yaml
articles:
    # ...
    order: sort
```