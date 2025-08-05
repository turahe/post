[![Tests](https://github.com/turahe/post/actions/workflows/run-test.yml/badge.svg)](https://github.com/turahe/post/actions/workflows/run-test.yml)
[![Release](https://github.com/turahe/post/actions/workflows/release.yml/badge.svg)](https://github.com/turahe/post/actions/workflows/release.yml)
[![Latest Version](https://img.shields.io/github/v/release/turahe/post)](https://github.com/turahe/post/releases)
[![PHP Version](https://img.shields.io/packagist/php-v/turahe/post)](https://packagist.org/packages/turahe/post)
[![Laravel Version](https://img.shields.io/packagist/dependency-v/turahe/post/laravel/framework)](https://packagist.org/packages/turahe/post)
[![Code Coverage](https://img.shields.io/badge/coverage-46%25-yellow)](https://github.com/turahe/post)
[![License](https://img.shields.io/github/license/turahe/post)](https://github.com/turahe/post/blob/master/LICENSE)
[![Stars](https://img.shields.io/github/stars/turahe/post)](https://github.com/turahe/post/stargazers)
[![Forks](https://img.shields.io/github/forks/turahe/post)](https://github.com/turahe/post/network)
[![Issues](https://img.shields.io/github/issues/turahe/post)](https://github.com/turahe/post/issues)
[![Pull Requests](https://img.shields.io/github/issues-pr/turahe/post)](https://github.com/turahe/post/pulls)

# 📝 Turahe Post

> **A powerful Laravel package for managing posts with rich content, markdown support, and comprehensive testing.**

[![Packagist](https://img.shields.io/packagist/v/turahe/post)](https://packagist.org/packages/turahe/post)
[![Packagist Downloads](https://img.shields.io/packagist/dt/turahe/post)](https://packagist.org/packages/turahe/post)
[![Packagist License](https://img.shields.io/packagist/l/turahe/post)](https://packagist.org/packages/turahe/post)

## 🚀 Quick Start

```bash
composer require turahe/post
```


## 📦 Installation

### Step 1: Install Package
```bash
composer require turahe/post
```

### Step 2: Publish Resources
```bash
php artisan vendor:publish --provider="Turahe\Post\PostServiceProvider"
```

### Step 3: Run Migrations
```bash
php artisan migrate
```

### Step 4: Done! 🎉
Your post management system is ready to use.

## ✨ Features

| Feature | Status | Description |
|---------|--------|-------------|
| 🎯 **Post Management** | ✅ Ready | Create, update, and manage posts with ease |
| 📝 **Content Support** | ✅ Ready | Rich content with markdown conversion |
| 🔗 **Slug Generation** | ✅ Ready | Automatic slug generation from titles |
| 🗑️ **Soft Deletes** | ✅ Ready | Safe deletion with data preservation |
| 👤 **User Stamps** | ✅ Ready | Track who created and modified posts |
| 📊 **Sorting** | ✅ Ready | Flexible post ordering and sorting |
| 📢 **Publishing** | ✅ Ready | Control post publication status |
| 🌍 **Multi-language** | ✅ Ready | Support for different languages |
| 🧪 **Comprehensive Testing** | ✅ Ready | 21 tests with 79 assertions |
| 🎨 **Code Quality** | ✅ Ready | PSR-12 compliant with Laravel Pint |

## 🚀 Quick Start

### 📝 Basic Usage

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

### 📊 Content Management

```php
// Get the latest content
$content = $post->getContent();

// Get word count and read time
echo $content->word_count; // Number of words
echo $content->read_time['text']; // "2 minutes"
```

### 📢 Publishing Posts

```php
// Publish a post
$post->update(['published_at' => now()]);

// Get published posts
$published = Post::published()->get();

// Get draft posts
$drafts = Post::notPublished()->get();
```

## 🤝 Contributing

We welcome contributions! Please ensure:

### 📋 Requirements
- ✅ **Code Quality**: Run `composer check` before submitting
- ✅ **Test Coverage**: Maintain or improve test coverage
- ✅ **Documentation**: Update documentation as needed

### 🧪 Testing Guidelines
- Write tests for new features
- Ensure existing tests pass
- Aim for 90%+ code coverage
- Test both happy path and edge cases

### 📊 Coverage Requirements
- **New Features**: Must have 90%+ coverage
- **Bug Fixes**: Must include regression tests
- **Refactoring**: Must maintain existing coverage levels

### 📈 Coverage Reports
For detailed coverage analysis, see:
- 📄 `COVERAGE_REPORT.md` - Comprehensive coverage analysis
- 🌐 `coverage/index.html` - Visual HTML report
- 📊 `coverage.xml` - XML data for CI/CD

## 🛠️ Development

### 🧪 Testing

```bash
# Run the test suite
composer test

# Run tests with coverage
composer test-coverage
```

### 🎨 Code Quality

```bash
# Check code style
composer pint-test

# Fix code style issues
composer pint

# Run all quality checks (code style + tests)
composer check
```

### 📊 Code Coverage

```bash
# Run tests with coverage analysis
$env:XDEBUG_MODE="coverage"; composer test-coverage
```

**📈 Current Coverage:** 46% overall (23/50 statements)

| Component | Coverage | Status | Priority |
|-----------|----------|--------|----------|
| ✅ Post Model | 100% | 🟢 Excellent | Maintain |
| ✅ HasContents Trait | 92.9% | 🟡 Very Good | Improve |
| ❌ Content Model | 0% | 🔴 Critical | Add Tests |
| ❌ PostServiceProvider | 0% | 🔴 Critical | Add Tests |

### 📋 Requirements

| Requirement | Version |
|-------------|---------|
| **PHP** | ^8.2 |
| **Laravel** | 9.x, 10.x, 11.x |
| **Database** | MySQL, PostgreSQL, SQLite |

## 🔄 CI/CD

This package uses GitHub Actions for continuous integration and deployment.

### 🧪 **Continuous Integration**
| Feature | Description |
|---------|-------------|
| 🧪 **Tests** | Runs on PHP 8.2, 8.3, and 8.4 |
| 🎨 **Code Quality** | Checks code style using Laravel Pint |
| 🔒 **Security** | Runs security audits on dependencies |
| 📊 **Coverage** | Generates and uploads coverage reports to Codecov |

### 🚀 **Automatic Releases**
| Feature | Description |
|---------|-------------|
| 🏷️ **Trigger** | Pushes to tags (e.g., `v1.2.1`) |
| ⚡ **Process** | Runs tests → Creates GitHub release → Publishes to Packagist |
| 🔑 **Requirements** | Set `PACKAGIST_USERNAME` and `PACKAGIST_TOKEN` secrets |

### 🔄 **Automated Triggers**
- ✅ Push to `master` or `main` branches
- ✅ Pull requests to `master` or `main` branches
- ✅ **Tag pushes** (triggers automatic release)

## 📊 Code Coverage Status

| Component | Coverage | Status | Priority |
|-----------|----------|--------|----------|
| ✅ Post Model | 100% | 🟢 Excellent | Maintain |
| ✅ HasContents Trait | 92.9% | 🟡 Very Good | Improve |
| ❌ Content Model | 0% | 🔴 Critical | Add Tests |
| ❌ PostServiceProvider | 0% | 🔴 Critical | Add Tests |

**📈 Overall Coverage:** 46% (23/50 statements)

### 🎯 Coverage Goals
| Goal | Target | Status |
|------|--------|--------|
| **Target** | 90%+ overall coverage | 🎯 In Progress |
| **Priority** | Add tests for Content model and PostServiceProvider | 📋 Planned |
| **Maintenance** | Keep Post model at 100% coverage | ✅ Maintained |

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## 🆘 Support

| Resource | Link |
|----------|------|
| 🐛 **Issues** | [GitHub Issues](https://github.com/turahe/post/issues) |
| 📚 **Documentation** | [Coverage Report](COVERAGE_REPORT.md) |
| 🔄 **CI/CD** | [GitHub Actions](https://github.com/turahe/post/actions) |
| 📦 **Packagist** | [Packagist Package](https://packagist.org/packages/turahe/post) |

## 📋 Changelog

### 🚀 v1.2.0 (Latest)
| Feature | Description |
|---------|-------------|
| ✨ **CI/CD Pipeline** | Comprehensive GitHub Actions workflow |
| 🧪 **Multi-PHP Testing** | Runs on PHP 8.2, 8.3, and 8.4 |
| 🎨 **Code Quality** | Laravel Pint integration |
| 🔒 **Security** | Composer audit integration |
| 📊 **Coverage** | Xdebug reporting with detailed analysis |
| 🔐 **Authentication** | Private repository support |
| 📦 **Packagist** | Custom repository support |
| 🚀 **Auto Release** | Automatic Packagist publishing on tag push |
| 📈 **Reports** | Detailed coverage analysis |
| 📚 **Documentation** | Comprehensive guides and examples |
| 🔧 **Updates** | Latest GitHub Actions versions |

### 📝 v1.1.0
| Feature | Description |
|---------|-------------|
| ✨ **Content Management** | Rich content features |
| 📝 **Markdown Support** | Full markdown conversion |
| 📊 **Analytics** | Word count and read time calculations |

### 🎉 v1.0.0
| Feature | Description |
|---------|-------------|
| 🎉 **Initial Release** | Basic package foundation |
| ✨ **Post Management** | Core post functionality |
| 🔗 **Slug Generation** | Automatic slug creation |
| 🗑️ **Soft Deletes** | Safe data deletion |

