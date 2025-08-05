[![run-tests](https://github.com/turahe/post/actions/workflows/run-test.yml/badge.svg)](https://github.com/turahe/post/actions/workflows/run-test.yml)
[![Latest Version](https://img.shields.io/github/v/release/turahe/post)](https://github.com/turahe/post/releases)
[![PHP Version](https://img.shields.io/packagist/php-v/turahe/post)](https://packagist.org/packages/turahe/post)
[![Code Coverage](https://img.shields.io/badge/coverage-46%25-yellow)](https://github.com/turahe/post)

# Turahe Post

A Laravel package for managing posts with content, markdown support, and comprehensive testing.


## Installation

1. Install the package via composer:

    ```shell
    composer require turahe/post
    ```

2. Publish resources (migrations and config files):

    ```shell
    php artisan vendor:publish --provider="Turahe\Post\PostServiceProvider"
    ```

3. Execute migrations via the following command:

    ```shell
    php artisan migrate
    ```

4. Done!

## Features

- ✅ **Post Management**: Create, update, and manage posts
- ✅ **Content Support**: Rich content with markdown conversion
- ✅ **Slug Generation**: Automatic slug generation from titles
- ✅ **Soft Deletes**: Safe deletion with data preservation
- ✅ **User Stamps**: Track who created and modified posts
- ✅ **Sorting**: Flexible post ordering and sorting
- ✅ **Publishing**: Control post publication status
- ✅ **Multi-language**: Support for different languages
- ✅ **Comprehensive Testing**: 21 tests with 79 assertions
- ✅ **Code Quality**: PSR-12 compliant with Laravel Pint

## Quick Start

### Basic Usage

```php
use Turahe\Post\Models\Post;

// Create a post
$post = Post::create([
    'title' => 'My First Post',
    'subtitle' => 'A subtitle',
    'description' => 'Post description',
    'type' => 'post',
]);

// Add content with markdown
$post->setContents('# Hello World\n\nThis is **markdown** content.');

// Get formatted content
echo $post->content; // HTML output
echo $post->content_raw; // Raw markdown
```

### Content Management

```php
// Get the latest content
$content = $post->getContent();

// Get word count and read time
echo $content->word_count; // Number of words
echo $content->read_time['text']; // "2 minutes"
```

### Publishing Posts

```php
// Publish a post
$post->update(['published_at' => now()]);

// Get published posts
$published = Post::published()->get();

// Get draft posts
$drafts = Post::notPublished()->get();
```

## Contributing

When contributing to this package, please ensure:

1. **Code Quality**: Run `composer check` before submitting
2. **Test Coverage**: Maintain or improve test coverage
3. **Documentation**: Update documentation as needed

### Testing Guidelines

- Write tests for new features
- Ensure existing tests pass
- Aim for 90%+ code coverage
- Test both happy path and edge cases

### Coverage Requirements

- **New Features**: Must have 90%+ coverage
- **Bug Fixes**: Must include regression tests
- **Refactoring**: Must maintain existing coverage levels

### Coverage Reports

For detailed coverage analysis, see:
- `COVERAGE_REPORT.md` - Comprehensive coverage analysis
- `coverage/index.html` - Visual HTML report
- `coverage.xml` - XML data for CI/CD

## Development

### Testing

Run the test suite:

```shell
composer test
```

Run tests with coverage:

```shell
composer test-coverage
```

### Code Quality

Check code style:

```shell
composer pint-test
```

Fix code style issues:

```shell
composer pint
```

Run all quality checks (code style + tests):

```shell
composer check
```

### Code Coverage

Run tests with coverage analysis:

```shell
$env:XDEBUG_MODE="coverage"; composer test-coverage
```

View coverage reports:
- HTML report: `coverage/index.html`
- XML report: `coverage.xml`
- Detailed analysis: `COVERAGE_REPORT.md`

**Current Coverage:** 46% overall (23/50 statements)
- ✅ Post Model: 100% coverage
- ✅ HasContents Trait: 92.9% coverage  
- ❌ Content Model: 0% coverage (needs tests)
- ❌ PostServiceProvider: 0% coverage (needs tests)

### Requirements

- **PHP**: ^8.2
- **Laravel**: 9.x, 10.x, 11.x
- **Database**: MySQL, PostgreSQL, SQLite

## CI/CD

This package uses GitHub Actions for continuous integration. The workflow includes:

- **Tests**: Runs on PHP 8.2, 8.3, and 8.4
- **Code Quality**: Checks code style using Laravel Pint
- **Security**: Runs security audits on dependencies
- **Coverage**: Generates and uploads coverage reports to Codecov

The CI pipeline will run automatically on:
- Push to `master` or `main` branches
- Pull requests to `master` or `main` branches

## Code Coverage Status

| Component | Coverage | Status | Priority |
|-----------|----------|--------|----------|
| Post Model | 100% | ✅ Excellent | Maintain |
| HasContents Trait | 92.9% | ✅ Very Good | Improve |
| Content Model | 0% | ❌ Critical | Add Tests |
| PostServiceProvider | 0% | ❌ Critical | Add Tests |

**Overall Coverage:** 46% (23/50 statements)

### Coverage Goals
- **Target:** 90%+ overall coverage
- **Priority:** Add tests for Content model and PostServiceProvider
- **Maintenance:** Keep Post model at 100% coverage

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Support

- **Issues**: [GitHub Issues](https://github.com/turahe/post/issues)
- **Documentation**: [Coverage Report](COVERAGE_REPORT.md)
- **CI/CD**: [GitHub Actions](https://github.com/turahe/post/actions)

## Changelog

### v1.2.0 (Latest)
- ✨ Add comprehensive CI/CD pipeline
- ✨ Add multi-PHP version testing (8.2, 8.3, 8.4)
- ✨ Add code quality checks with Laravel Pint
- ✨ Add security audits with Composer audit
- ✨ Add code coverage reporting with Xdebug
- ✨ Add private repository authentication support
- ✨ Add custom Packagist repository support
- 📊 Add detailed coverage analysis and reports
- 📚 Add comprehensive documentation
- 🔧 Update all GitHub Actions to latest versions

### v1.1.0
- ✨ Add content management features
- ✨ Add markdown support
- ✨ Add word count and read time calculations

### v1.0.0
- 🎉 Initial release
- ✨ Basic post management
- ✨ Slug generation
- ✨ Soft deletes

