# Bolt's Journal - Critical Learnings Only

## 2025-05-15 - Initial Journal
**Learning:** Starting as Bolt in this repository.
**Action:** Always look for measurable wins in CI4 architecture.

## 2026-03-13 - Optimizing List Fetches in CI4
**Learning:** Fetching all columns (`SELECT *`) in list views, especially when tables contain `LONGTEXT` or `TEXT` fields (like `news.content`), causes unnecessary memory consumption and slower database response times. Additionally, missing limits on public listings creates a performance risk as data grows.
**Action:** Always provide a specific `select` string when fetching records for index/list pages. Add a `limit` for public listings to prevent DOS, but ensure pagination is implemented before adding hard limits to administrative lists to avoid hiding data from users.
