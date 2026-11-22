import assert from 'node:assert/strict'
import { execFileSync } from 'node:child_process'
import { after, before, test } from 'node:test'
import { build } from 'esbuild'
import { chromium } from 'playwright'

const first = '11111111-1111-4111-8111-111111111111'
const second = '22222222-2222-4222-8222-222222222222'

const render = (behavior) =>
    execFileSync(
        process.env.PHP_BINARY ?? 'php',
        [
            'packages/widget-content-reveal/tests/Support/render-content-reveal.php',
        ],
        {
            input: JSON.stringify(
                [first, second].map((id, index) => ({
                    title: `Card ${index + 1}`,
                    teaser: 'Teaser',
                    buttonLabel: `Open ${index + 1}`,
                    behavior,
                    targetInstanceId: id,
                })),
            ),
            encoding: 'utf8',
        },
    )

let browser
let runtime
before(async () => {
    browser = await chromium.launch()
    const bundle = await build({
        entryPoints: [
            'vendor/capell-app/frontend/resources/js/widget-runtime.js',
        ],
        bundle: true,
        write: false,
    })
    runtime = bundle.outputFiles[0].text
})
after(async () => browser?.close())

const open = async (behavior) => {
    const page = await browser.newPage()
    await page.route('**/widgets/*', (route) =>
        route.fulfill({
            contentType: 'application/json',
            body: JSON.stringify({
                version: 2,
                status: 'ok',
                html: `<p data-revealed>${route.request().url().split('/').pop()}</p>`,
                resource_ids: [],
            }),
        }),
    )
    await page.goto('http://localhost/widgets/page')
    await page.setContent(render(behavior))
    await page.addScriptTag({ content: runtime })
    await page.getByRole('link', { name: 'Open 2' }).click()
    await page
        .locator('.capell-interaction-inline[aria-busy="false"]')
        .waitFor()
    return page
}

test('inline reveal opens the chosen target beside its own card and keeps the trigger', async () => {
    const page = await open('inline_reveal')
    try {
        const card = page.locator('article', { hasText: 'Card 2' })
        assert.equal(
            await card.locator('[data-revealed]').textContent(),
            second,
        )
        assert.equal(await page.locator('[data-revealed]').count(), 1)
        assert.equal(
            await card.getByRole('link', { name: 'Open 2' }).count(),
            1,
        )
        assert.equal(
            await card
                .locator('[data-capell-interaction-status]')
                .textContent(),
            '',
        )
    } finally {
        await page.close()
    }
})

test('replace region swaps only the chosen card trigger for its target', async () => {
    const page = await open('replace_region')
    try {
        const card = page.locator('article', { hasText: 'Card 2' })
        assert.equal(
            await card.locator('[data-revealed]').textContent(),
            second,
        )
        assert.equal(
            await card.getByRole('link', { name: 'Open 2' }).count(),
            0,
        )
        assert.equal(
            await page.getByRole('link', { name: 'Open 1' }).count(),
            1,
        )
        assert.ok(await page.getByRole('heading', { name: 'More' }).isVisible())
    } finally {
        await page.close()
    }
})
