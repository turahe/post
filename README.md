[![run-tests](https://github.com/turahe/post/actions/workflows/run-test.yml/badge.svg)](https://github.com/turahe/post/actions/workflows/run-test.yml)

# Turahe Post


## Installation

1. Install the package via composer:

    ```shell
    composer require turahe/post
    ```

2. Publish resources (migrations and config files):

    ```shell
    php artisan vendor:publish --provider="Turahe\Core\PostServiceProvider"
    ```

3. Execute migrations via the following command:

    ```shell
    php artisan migrate
    ```

4. Done!

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

