# Contributing to Money

Thank you for your interest in contributing to Money! This guide will help you get started.

## 🤝 How to Contribute

### Reporting Bugs

- Use the [GitHub Issues](https://github.com/yourusername/money/issues) page
- Provide a clear and descriptive title
- Include steps to reproduce the issue
- Add screenshots if applicable
- Specify your environment (OS, PHP version, browser)

### Suggesting Features

- Open an issue with the "enhancement" label
- Describe the feature and why it would be useful
- Provide examples of how you envision it working

### Code Contributions

1. **Fork the repository**
   ```bash
   git clone https://github.com/yourusername/money.git
   ```

2. **Create a feature branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

3. **Make your changes**
   - Follow the existing code style
   - Add tests for new functionality
   - Update documentation if needed

4. **Run tests**
   ```bash
   php artisan test
   ./vendor/bin/pint
   ```

5. **Commit your changes**
   ```bash
   git commit -m "feat: add your feature description"
   ```

6. **Push to your fork**
   ```bash
   git push origin feature/your-feature-name
   ```

7. **Create a Pull Request**
   - Provide a clear description of your changes
   - Link any related issues
   - Ensure all CI checks pass

## 📝 Coding Standards

### PHP Code Style

This project uses [Laravel Pint](https://github.com/laravel/pint) for code formatting:

```bash
./vendor/bin/pint
```

### General Guidelines

- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Add type hints where possible
- Write clear, concise comments
- Keep methods small and focused

### Livewire Components

- Follow Laravel Livewire best practices
- Use proper validation rules
- Implement proper error handling
- Optimize database queries

## 🧪 Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter Feature/ExampleTest

# Run with coverage
php artisan test --coverage
```

### Writing Tests

- Test both happy paths and edge cases
- Use factories for test data
- Mock external services when appropriate
- Ensure tests are independent and repeatable

## 📚 Documentation

- Update README.md for significant changes
- Add inline comments for complex logic
- Document new configuration options
- Update API documentation if applicable

## 🚀 Development Setup

1. Clone your fork
2. Install dependencies: `composer install && npm install`
3. Copy `.env.example` to `.env` and configure
4. Run migrations: `php artisan migrate`
5. Install front-end dependencies: `npm install`
6. Compile assets: `npm run dev`
7. Start development server: `php artisan serve`

## 📋 Pull Request Checklist

Before submitting a PR, ensure:

- [ ] Code follows project style guidelines
- [ ] All tests pass
- [ ] New functionality is tested
- [ ] Documentation is updated
- [ ] No breaking changes (or clearly documented)
- [ ] Commit messages are clear and descriptive

## 🏷️ Commit Message Convention

We use conventional commits:

- `feat:` New feature
- `fix:` Bug fix
- `docs:` Documentation changes
- `style:` Code style changes (formatting, etc.)
- `refactor:` Code refactoring
- `test:` Adding or updating tests
- `chore:` Maintenance tasks

Examples:
```
feat: add cryptocurrency portfolio tracking
fix: resolve issue with bank account balance calculation
docs: update installation instructions
```

## 🤔 Getting Help

- Check existing issues and discussions
- Read the project documentation
- Ask questions in GitHub Discussions
- Join our community (link to be added)

## 📄 License

By contributing, you agree that your contributions will be licensed under the MIT License.

---

Thank you for contributing to Money! 🎉