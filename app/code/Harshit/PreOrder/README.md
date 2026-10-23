# Harshit_PreOrder

`Harshit_PreOrder` is a standalone Magento Open Source 2.4.8 pre-order request module for PHP 8.2–8.4. It has no project-specific dependencies.

The product-view layout renders a Magento validation form on every product page. The POST-only controller uses the Magento form key, validates the request and product, records catalog name/SKU snapshots, and saves through `PreOrderRepositoryInterface`. `submitted_at` is set in the browser at submit time and is validated server-side; `created_at` remains a database-generated timestamp.

The module uses declarative schema (`etc/db_schema.xml`) and a data patch that creates two sample requests only when a product exists. The Sales > Pre Orders UI component grid provides sorting, filters, column controls, bookmarks, CSV/XML export, pagination, and a safely escaped product edit link.

## Web API

Both endpoints are protected by `Harshit_PreOrder::preorders`; neither permits anonymous access because pre-order requests contain personal data. Use an integration access token with that permission.

```bash
curl -H "Authorization: Bearer $TOKEN" http://magento.local/rest/V1/preorders
curl -H "Authorization: Bearer $TOKEN" http://magento.local/rest/V1/preorders/1
```

The list is returned newest first. A missing ID receives Magento's standard `NoSuchEntityException` 404 response. A successful single-record response is shaped like this (the list endpoint returns an array of these objects):

```json
{
  "entity_id": 1,
  "first_name": "Sample",
  "last_name": "Customer One",
  "mobile": "1234567890",
  "location": "Sample Location",
  "product_id": 1,
  "product_name": "Sample Product",
  "product_sku": "sample-product",
  "submitted_at": "2026-10-23 10:00:00",
  "created_at": "2026-10-23 10:00:00"
}
```

The external client is deliberately not inside this module. It is delivered as sibling `preorder-webservice-client/` and runs as a separate PHP application. See the delivery `INSTALL.md` and `preorder-webservice-client/README.md` for installation and token setup.

The optional product quick-view popup was intentionally not implemented.
