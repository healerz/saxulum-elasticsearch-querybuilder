# QueryBuilder

## Match all

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('match_all', $qb->objectNode(), true)
;

echo $qb->json();
```

```json
{"query":{"match_all":{}}}
```

## Match

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('match', $qb->objectNode())
            ->addToObjectNode('title', $qb->stringNode('elasticsearch'))
;

echo $qb->json();
```

```json
{"query":{"match":{"title":"elasticsearch"}}}
```

## Range

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
->addToObjectNode('query', $qb->objectNode())
    ->addToObjectNode('range', $qb->objectNode())
        ->addToObjectNode('elements', $qb->objectNode())
            ->addToObjectNode('gte', $qb->intNode(10))
            ->addToObjectNode('lte', $qb->intNode(20))
;

echo $qb->json();
```

```json
{"query":{"range":{"elements":{"gte":10,"lte":20}}}}
```

## Exists

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('exists', $qb->objectNode())
            ->addToObjectNode('field', $qb->stringNode('text'))
;

echo $qb->json();
```

```json
{"query":{"exists":{"field":"text"}}}
```

## Not Exists

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('bool', $qb->objectNode())
            ->addToObjectNode('must_not', $qb->arrayNode())
                ->addToArrayNode($qb->objectNode())
                    ->addToObjectNode('exists', $qb->objectNode())
                        ->addToObjectNode('field', $qb->stringNode('text'))
;

echo $qb->json();
```

```json
{"query":{"bool":{"must_not":[{"exists":{"field":"text"}}]}}}
```

## Prefix

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('prefix', $qb->objectNode())
            ->addToObjectNode('title', $qb->stringNode('elastic'))
;

echo $qb->json();
```

```json
{"query":{"prefix":{"title":"elastic"}}}
```

## Wildcard

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('wildcard', $qb->objectNode())
            ->addToObjectNode('title', $qb->stringNode('ela*c'))
;

echo $qb->json();
```

```json
{"query":{"wildcard":{"title":"ela*c"}}}
```

## Regexp

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('regexp', $qb->objectNode())
            ->addToObjectNode('title', $qb->stringNode('search$'))
;

echo $qb->json();
```

```json
{"query":{"regexp":{"title":"search$"}}}
```

## Fuzzy

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('fuzzy', $qb->objectNode())
            ->addToObjectNode('title', $qb->objectNode())
                ->addToObjectNode('value', $qb->stringNode('sea'))
                ->addToObjectNode('fuzziness', $qb->intNode(2))
;

echo $qb->json();
```

```json
{"query":{"fuzzy":{"title":{"value":"sea","fuzziness":2}}}}
```

## Type

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('type', $qb->objectNode())
            ->addToObjectNode('value', $qb->stringNode('product'))
;

echo $qb->json();
```

```json
{"query":{"type":{"value":"product"}}}
```

## Ids

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('ids', $qb->objectNode())
            ->addToObjectNode('type', $qb->stringNode('product'))
            ->addToObjectNode('values', $qb->arrayNode())
                ->addToArrayNode($qb->intNode(1))
                ->addToArrayNode($qb->intNode(2))
;

echo $qb->json();
```

```json
{"query":{"ids":{"type":"product","values":[1,2]}}}
```

## Bool Term

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('term', $qb->objectNode())
            ->addToObjectNode('is_published', $qb->boolNode(true))
;

echo $qb->json();
```

```json
{"query":{"term":{"is_published":true}}}
```

## Complex sample

```php
use Saxulum\ElasticSearchQueryBuilder\QueryBuilder;

$qb = new QueryBuilder();
$qb
    ->addToObjectNode('query', $qb->objectNode())
        ->addToObjectNode('bool', $qb->objectNode())
            ->addToObjectNode('must', $qb->objectNode())
                ->addToObjectNode('term', $qb->objectNode())
                    ->addToObjectNode('user', $qb->stringNode('kimchy'))
                ->end()
            ->end()
            ->addToObjectNode('filter', $qb->objectNode())
                ->addToObjectNode('term', $qb->objectNode())
                    ->addToObjectNode('tag', $qb->stringNode('tech'))
                ->end()
            ->end()
            ->addToObjectNode('must_not', $qb->objectNode())
                ->addToObjectNode('range', $qb->objectNode())
                    ->addToObjectNode('age', $qb->objectNode())
                        ->addToObjectNode('from', $qb->intNode(10))
                        ->addToObjectNode('to', $qb->intNode(20))
                    ->end()
                ->end()
            ->end()
            ->addToObjectNode('should', $qb->arrayNode())
                ->addToArrayNode($qb->objectNode())
                    ->addToObjectNode('term', $qb->objectNode())
                        ->addToObjectNode('tag', $qb->stringNode('wow'))
                    ->end()
                ->end()
                ->addToArrayNode($qb->objectNode())
                    ->addToObjectNode('term', $qb->objectNode())
                        ->addToObjectNode('tag', $qb->stringNode('elasticsearch'))
                    ->end()
                ->end()
            ->end()
            ->addToObjectNode('minimum_should_match', $qb->intNode(1))
            ->addToObjectNode('boost', $qb->floatNode(1.1))
;

echo $qb->json(true);
```

```json
{
    "query": {
        "bool": {
            "must": {
                "term": {
                    "user": "kimchy"
                }
            },
            "filter": {
                "term": {
                    "tag": "tech"
                }
            },
            "must_not": {
                "range": {
                    "age": {
                        "from": 10,
                        "to": 20
                    }
                }
            },
            "should": [
                {
                    "term": {
                        "tag": "wow"
                    }
                },
                {
                    "term": {
                        "tag": "elasticsearch"
                    }
                }
            ],
            "minimum_should_match": 1,
            "boost": 1.1
        }
    }
}
```