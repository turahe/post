# Code Coverage Report

## Overview

This report provides a comprehensive analysis of code coverage for the Turahe Post package.

**Generated:** $(Get-Date -Format "yyyy-MM-dd HH:mm:ss")
**Total Files:** 4
**Total Lines of Code:** 254
**Total Classes:** 4
**Total Methods:** 14

## Coverage Summary

| Metric | Value |
|--------|-------|
| **Overall Coverage** | 46% (23/50 statements) |
| **Methods Covered** | 71.4% (10/14 methods) |
| **Classes Covered** | 50% (2/4 classes) |
| **Files Covered** | 50% (2/4 files) |

## File-by-File Coverage

### ✅ Well Covered Files

#### 1. `src/Models/Post.php` - 100% Coverage
- **Lines:** 96 total, 74 non-comment
- **Methods:** 4/4 covered (100%)
- **Statements:** 10/10 covered (100%)
- **Complexity:** 4

**Covered Methods:**
- `casts()` - 100% covered
- `getSlugOptions()` - 100% covered  
- `scopePublished()` - 100% covered
- `scopeNotPublished()` - 100% covered

**Test Coverage:** Excellent - All methods and functionality are thoroughly tested.

#### 2. `src/Concerns/HasContents.php` - 92.9% Coverage
- **Lines:** 65 total, 57 non-comment
- **Methods:** 6/7 covered (85.7%)
- **Statements:** 13/14 covered (92.9%)
- **Complexity:** 7

**Covered Methods:**
- `bootHasContents()` - 100% covered
- `contents()` - 100% covered
- `getContent()` - 100% covered
- `contentHtml()` - 100% covered
- `contentRaw()` - 100% covered
- `setContents()` - 100% covered

**Uncovered Method:**
- `content()` - 0% covered (line 45-47)

**Test Coverage:** Very Good - Only one minor method is uncovered.

### ❌ Poorly Covered Files

#### 3. `src/Models/Content.php` - 0% Coverage
- **Lines:** 64 total, 55 non-comment
- **Methods:** 0/2 covered (0%)
- **Statements:** 0/16 covered (0%)
- **Complexity:** 4
- **CRAP Index:** 20 (High Risk)

**Uncovered Methods:**
- `wordCount()` - 0% covered (lines 34-41)
- `readTime()` - 0% covered (lines 44-61)

**Issues:**
- No tests exist for this model
- High complexity methods without coverage
- High CRAP index indicates risky code

#### 4. `src/PostServiceProvider.php` - 0% Coverage
- **Lines:** 29 total, 26 non-comment
- **Methods:** 0/1 covered (0%)
- **Statements:** 0/10 covered (0%)
- **Complexity:** 2
- **CRAP Index:** 6

**Uncovered Methods:**
- `boot()` - 0% covered (lines 12-25)

**Issues:**
- No tests for service provider functionality
- Laravel service provider methods are typically hard to test

## Test Analysis

### Current Test Suite
- **Total Tests:** 21
- **Total Assertions:** 79
- **Test Files:** 3
  - `tests/Unit/PostTest.php` - 9 tests
  - `tests/Unit/ContentTest.php` - 12 tests
  - `tests/Feature/Concerns/HasContentTest.php` - Feature tests

### Test Coverage by Component

#### ✅ Post Model Tests
- **Coverage:** 100%
- **Tests:** 9 unit tests
- **Areas Covered:**
  - CRUD operations (create, read, update, delete)
  - Slug generation
  - Scopes (published, not published)
  - Soft deletes
  - Sorting functionality

#### ✅ HasContents Trait Tests
- **Coverage:** 92.9%
- **Tests:** Feature tests
- **Areas Covered:**
  - Content relationship
  - Content creation with markdown conversion
  - Content retrieval
  - Model deletion cascade

#### ❌ Content Model Tests
- **Coverage:** 0%
- **Tests:** 12 tests exist but don't cover the actual methods
- **Missing Coverage:**
  - `wordCount()` attribute
  - `readTime()` attribute
  - Attribute logic and calculations

#### ❌ PostServiceProvider Tests
- **Coverage:** 0%
- **Tests:** None
- **Missing Coverage:**
  - Service provider boot method
  - Configuration merging
  - Migration loading
  - Asset publishing

## Recommendations

### High Priority (Critical)

1. **Add Content Model Tests**
   ```php
   // tests/Unit/ContentTest.php
   public function test_word_count_attribute()
   public function test_read_time_attribute()
   public function test_read_time_with_zero_words()
   public function test_read_time_with_less_than_minute()
   ```

2. **Add Service Provider Tests**
   ```php
   // tests/Unit/PostServiceProviderTest.php
   public function test_config_is_merged()
   public function test_migrations_are_loaded()
   public function test_assets_are_published()
   ```

### Medium Priority

3. **Improve HasContents Coverage**
   - Add test for the uncovered `content()` method
   - Test edge cases in markdown conversion

4. **Add Integration Tests**
   - Test full post creation with content
   - Test content updates and deletions
   - Test markdown conversion edge cases

### Low Priority

5. **Code Quality Improvements**
   - Reduce complexity in Content model methods
   - Add more comprehensive error handling
   - Improve method documentation

## Coverage Goals

| Component | Current | Target | Priority |
|-----------|---------|--------|----------|
| Post Model | 100% | 100% | ✅ Maintain |
| HasContents | 92.9% | 100% | 🔶 Improve |
| Content Model | 0% | 90%+ | 🔴 Critical |
| PostServiceProvider | 0% | 80%+ | 🔴 Critical |

## Next Steps

1. **Immediate:** Write tests for Content model attributes
2. **Short-term:** Add service provider tests
3. **Medium-term:** Improve integration test coverage
4. **Long-term:** Maintain 90%+ overall coverage

## Running Coverage

```bash
# Set Xdebug mode and run coverage
$env:XDEBUG_MODE="coverage"; composer test-coverage

# View HTML report
start coverage/index.html

# View XML report
cat coverage.xml
```

---

*Report generated by PHPUnit with Xdebug coverage driver* 